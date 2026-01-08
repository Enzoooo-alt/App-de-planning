<?php

/**
 * Contrôleur de gestion des présences - Lyon Palme
 * 
 * Gère le système de présences des adhérents aux séances.
 * Permet aux entraîneurs de marquer les présences et de suivre l'assiduité.
 * 
 * Fonctionnalités:
 * - Feuille de présence par séance
 * - Marquage des présences/absences/excuses
 * - Statistiques de présence par adhérent
 * - Alertes pour absences répétées
 * 
 * @package App\Http\Controllers
 * @author Lyon Palme Development Team
 * @version 1.0
 */

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Seance;
use App\Models\Adherent;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    /**
     * Afficher la feuille de présence pour une séance
     */
    public function manage(Seance $seance)
    {
        $seance->load(['entrainement', 'entraineur']);
        
        // Récupérer tous les adhérents actifs
        $adherents = Adherent::where('actif', true)->orderBy('nom')->get();
        
        // Récupérer les présences déjà enregistrées pour cette séance
        $presences = Presence::where('seance_id', $seance->id)
            ->get()
            ->keyBy('adherent_id');
        
        return view('presences.manage-v2', compact('seance', 'adherents', 'presences'));
    }

    /**
     * Enregistrer ou mettre à jour les présences d'une séance
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'seance_id' => 'required|exists:seance,id',
            'presences' => 'required|array',
            'presences.*.adherent_id' => 'required|exists:adherent,id',
            'presences.*.statut' => 'required|in:present,absent,excuse',
            'presences.*.note' => 'nullable|string|max:500',
        ]);

        foreach ($validated['presences'] as $presenceData) {
            Presence::updateOrCreate(
                [
                    'seance_id' => $validated['seance_id'],
                    'adherent_id' => $presenceData['adherent_id']
                ],
                [
                    'statut' => $presenceData['statut'],
                    'note' => $presenceData['note'] ?? null
                ]
            );
        }

        return redirect()->back()
            ->with('success', 'Présences enregistrées avec succès.');
    }

    /**
     * Afficher les statistiques de présence d'un adhérent
     */
    public function statistics(Adherent $adherent)
    {
        // Récupérer toutes les présences de l'adhérent
        $presences = Presence::where('adherent_id', $adherent->id)
            ->with('seance.entrainement')
            ->latest('created_at')
            ->get();
        
        // Calculer les statistiques
        $total = $presences->count();
        $presents = $presences->where('statut', 'present')->count();
        $absents = $presences->where('statut', 'absent')->count();
        $excuses = $presences->where('statut', 'excuse')->count();
        
        $tauxPresence = $total > 0 ? round(($presents / $total) * 100, 1) : 0;
        
        // Récupérer les 5 dernières absences non excusées
        $dernieresAbsences = Presence::where('adherent_id', $adherent->id)
            ->where('statut', 'absent')
            ->with('seance.entrainement')
            ->latest('created_at')
            ->limit(5)
            ->get();
        
        return view('presences.statistics-v2', compact('adherent', 'presences', 'total', 'presents', 'absents', 'excuses', 'tauxPresence', 'dernieresAbsences'));
    }

    /**
     * Afficher la liste des adhérents avec leur taux de présence
     */
    public function index()
    {
        $adherents = Adherent::where('actif', true)
            ->with('presences')
            ->orderBy('nom')
            ->get()
            ->map(function ($adherent) {
                $totalPresences = $adherent->presences->count();
                $presents = $adherent->presences->where('statut', 'present')->count();
                $adherent->taux_presence = $totalPresences > 0 ? round(($presents / $totalPresences) * 100, 1) : 0;
                $adherent->total_presences = $totalPresences;
                $adherent->total_presents = $presents;
                $adherent->total_absents = $adherent->presences->where('statut', 'absent')->count();
                return $adherent;
            })
            ->sortByDesc('taux_presence');
        
        return view('presences.index-v2', compact('adherents'));
    }
}
