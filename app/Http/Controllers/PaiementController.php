<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Adherent;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::with('adherent')
            ->latest('date_paiement')
            ->paginate(20);
        
        $stats = [
            'total' => Paiement::where('statut', 'valide')->sum('montant'),
            'en_attente' => Paiement::where('statut', 'en_attente')->count(),
            'valides' => Paiement::where('statut', 'valide')->count(),
            'total_paiements' => Paiement::count(),
        ];
        
        return view('paiements.index-v2', compact('paiements', 'stats'));
    }

    public function create()
    {
        $adherents = Adherent::where('actif', true)->orderBy('nom')->get();
        return view('paiements.create-v2', compact('adherents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'adherent_id' => 'required|exists:adherent,id',
            'montant' => 'required|numeric|min:0',
            'type' => 'required|in:cotisation_annuelle,stage,competition,equipement,autre',
            'methode_paiement' => 'required|in:especes,cheque,virement,carte_bancaire,en_ligne',
            'statut' => 'required|in:en_attente,valide,refuse,rembourse',
            'date_paiement' => 'required|date',
            'saison' => 'nullable|string|max:20',
            'recu_numero' => 'nullable|string|max:50|unique:paiements',
            'note' => 'nullable|string|max:1000',
        ]);

        // Adapter le nom de colonne
        $validated['methode'] = $validated['methode_paiement'];
        unset($validated['methode_paiement']);

        Paiement::create($validated);

        return redirect()->route('paiements.index')
            ->with('success', 'Paiement enregistré avec succès.');
    }

    public function show(Paiement $paiement)
    {
        $paiement->load('adherent');
        return view('paiements.show-v2', compact('paiement'));
    }

    public function edit(Paiement $paiement)
    {
        $adherents = Adherent::where('actif', true)->orderBy('nom')->get();
        return view('paiements.edit-v2', compact('paiement', 'adherents'));
    }

    public function update(Request $request, Paiement $paiement)
    {
        $validated = $request->validate([
            'adherent_id' => 'required|exists:adherent,id',
            'montant' => 'required|numeric|min:0',
            'type' => 'required|in:cotisation_annuelle,stage,competition,equipement,autre',
            'methode_paiement' => 'required|in:especes,cheque,virement,carte_bancaire,en_ligne',
            'statut' => 'required|in:en_attente,valide,refuse,rembourse',
            'date_paiement' => 'required|date',
            'saison' => 'nullable|string|max:20',
            'recu_numero' => 'nullable|string|max:50|unique:paiements,recu_numero,' . $paiement->id,
            'note' => 'nullable|string|max:1000',
        ]);

        // Adapter le nom de colonne
        $validated['methode'] = $validated['methode_paiement'];
        unset($validated['methode_paiement']);

        $ancienStatut = $paiement->statut;
        $paiement->update($validated);

        // Notifier l'adhérent si le paiement vient d'être validé
        if ($ancienStatut !== 'valide' && $validated['statut'] === 'valide') {
            if ($paiement->adherent->user_id) {
                $user = \App\Models\User::find($paiement->adherent->user_id);
                if ($user) {
                    $user->notify(new \App\Notifications\PaiementValidatedNotification($paiement));
                }
            }
        }

        return redirect()->route('paiements.show', $paiement)
            ->with('success', 'Paiement mis à jour avec succès.');
    }

    public function destroy(Paiement $paiement)
    {
        $paiement->delete();

        return redirect()->route('paiements.index')
            ->with('success', 'Paiement supprimé avec succès.');
    }

    public function dashboard()
    {
        $saisonActuelle = '2025-2026';
        
        $stats = [
            'total_encaisse' => Paiement::where('statut', 'valide')->sum('montant'),
            'cotisations_payees' => Paiement::where('type', 'cotisation_annuelle')
                ->where('statut', 'valide')
                ->where('saison', $saisonActuelle)
                ->count(),
            'cotisations_impayees' => Adherent::where('actif', true)->count() - 
                Paiement::where('type', 'cotisation_annuelle')
                    ->where('statut', 'valide')
                    ->where('saison', $saisonActuelle)
                    ->distinct('adherent_id')
                    ->count(),
            'en_attente' => Paiement::where('statut', 'en_attente')->sum('montant'),
        ];
        
        $paiementsRecents = Paiement::with('adherent')
            ->latest('created_at')
            ->limit(10)
            ->get();
        
        $paiementsParType = Paiement::where('statut', 'valide')
            ->selectRaw('type, SUM(montant) as total')
            ->groupBy('type')
            ->get();
        
        return view('paiements.dashboard-v2', compact('stats', 'paiementsRecents', 'paiementsParType', 'saisonActuelle'));
    }
}
