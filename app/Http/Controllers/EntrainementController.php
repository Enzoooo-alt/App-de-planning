<?php

/**
 * Contrôleur de gestion des entraînements - Lyon Palme
 * 
 * Gère toutes les opérations CRUD (Create, Read, Update, Delete) pour les entraînements
 * du club de natation Lyon Palme. Permet la création, modification, consultation et 
 * suppression des programmes d'entraînement avec leurs entraîneurs associés.
 * 
 * Fonctionnalités:
 * - Affichage de la liste des entraînements avec pagination
 * - Création et modification d'entraînements avec validation
 * - Consultation détaillée avec séances et commentaires
 * - Association avec les entraîneurs du club
 * - Gestion des permissions selon les rôles utilisateurs
 * 
 * @package App\Http\Controllers
 * @author Lyon Palme Development Team
 * @version 1.0
 */

namespace App\Http\Controllers;

use App\Models\Entrainement;
use App\Models\Entraineur;
use Illuminate\Http\Request;

class EntrainementController extends Controller
{
    /**
     * Affiche la liste paginée de tous les entraînements
     * 
     * Récupère tous les entraînements avec leurs entraîneurs associés,
     * les trie par date de création (plus récents en premier) et les pagine.
     * 
     * @return \Illuminate\Contracts\View\View Vue avec liste des entraînements
     */
    public function index()
    {
        $entrainements = Entrainement::with('entraineur.user')
            ->withCount('seances')
            ->latest()
            ->paginate(15);
        
        // Statistiques pour le dashboard
        $stats = [
            'total_seances' => \App\Models\Seance::count(),
            'total_entraineurs' => Entraineur::count(),
            'programmes_actifs' => Entrainement::whereHas('seances', function($q) {
                $q->where('date_seance', '>=', now());
            })->count(),
        ];
        
        return view('entrainements.index-v2', compact('entrainements', 'stats'));
    }

    /**
     * Affiche le formulaire de création d'un nouvel entraînement
     * 
     * Charge la liste de tous les entraîneurs disponibles pour permettre
     * l'association lors de la création de l'entraînement.
     * 
     * @return \Illuminate\Contracts\View\View Vue du formulaire de création
     */
    public function create()
    {
        $entraineurs = Entraineur::with('user')->get();
        return view('entrainements.create-v2', compact('entraineurs'));
    }

    /**
     * Enregistre un nouvel entraînement en base de données
     * 
     * Valide les données soumises puis crée l'entraînement avec l'entraîneur associé.
     * Redirige vers la liste avec un message de confirmation.
     * 
     * @param \Illuminate\Http\Request $request Requête contenant les données
     * @return \Illuminate\Http\RedirectResponse Redirection vers la liste
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'entraineur_id' => 'required|exists:entraineur,id',
            'niveau' => 'nullable|in:debutant,intermediaire,avance,competition',
            'description' => 'required|string',
            'objectifs' => 'nullable|string'
        ]);

        Entrainement::create($validated);

        return redirect()->route('entrainements.index')
                        ->with('success', 'Programme d\'entraînement créé avec succès.');
    }

    /**
     * Affiche les détails complets d'un entraînement
     * 
     * Charge l'entraînement avec toutes ses relations (entraîneur, séances,
     * commentaires et adhérents) pour un affichage détaillé.
     * 
     * @param \App\Models\Entrainement $entrainement L'entraînement à afficher
     * @return \Illuminate\Contracts\View\View Vue des détails de l'entraînement
     */
    public function show(Entrainement $entrainement)
    {
        $entrainement->load(['entraineur', 'seances', 'commentaires.adherent']);
        
        return view('entrainements.show', compact('entrainement'));
    }

    /**
     * Affiche le formulaire de modification d'un entraînement
     * 
     * Charge l'entraînement à modifier ainsi que la liste de tous les entraîneurs
     * pour permettre la modification de l'association.
     * 
     * @param \App\Models\Entrainement $entrainement L'entraînement à modifier
     * @return \Illuminate\Contracts\View\View Vue du formulaire de modification
     */
    public function edit(Entrainement $entrainement)
    {
        $entrainement->loadCount(['seances', 'commentaires']);
        $entraineurs = Entraineur::with('user')->get();
        return view('entrainements.edit-v2', compact('entrainement', 'entraineurs'));
    }

    /**
     * Met à jour un entraînement existant
     * 
     * Valide les nouvelles données puis met à jour l'entraînement en base.
     * Redirige vers la liste avec un message de confirmation.
     * 
     * @param \Illuminate\Http\Request $request Requête avec nouvelles données
     * @param \App\Models\Entrainement $entrainement L'entraînement à modifier
     * @return \Illuminate\Http\RedirectResponse Redirection vers la liste
     */
    public function update(Request $request, Entrainement $entrainement)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'entraineur_id' => 'required|exists:entraineur,id',
            'niveau' => 'nullable|in:debutant,intermediaire,avance,competition',
            'description' => 'required|string',
            'objectifs' => 'nullable|string'
        ]);

        $entrainement->update($validated);

        return redirect()->route('entrainements.index')
                        ->with('success', 'Programme d\'entraînement mis à jour avec succès.');
    }

    /**
     * Supprime un entraînement de la base de données
     * 
     * Supprime définitivement l'entraînement et toutes ses relations associées.
     * Redirige vers la liste avec un message de confirmation.
     * 
     * @param \App\Models\Entrainement $entrainement L'entraînement à supprimer
     * @return \Illuminate\Http\RedirectResponse Redirection vers la liste
     */
    public function destroy(Entrainement $entrainement)
    {
        $entrainement->delete();

        return redirect()->route('entrainements.index')
                        ->with('success', 'Entraînement supprimé avec succès.');
    }
}
