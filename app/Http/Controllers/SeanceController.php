<?php

/**
 * Contrôleur de gestion des séances - Lyon Palme
 * 
 * Gère toutes les opérations liées aux séances d'entraînement du club de natation.
 * Permet la planification, modification et consultation des créneaux d'entraînement
 * avec validation des horaires et association aux programmes d'entraînement.
 * 
 * Fonctionnalités principales:
 * - Planification des séances avec dates et horaires
 * - Validation des créneaux horaires (heure de fin > heure de début)
 * - Association des séances aux programmes d'entraînement
 * - Affichage chronologique des séances avec pagination
 * - Gestion des conflits d'horaires et des disponibilités
 * 
 * @package App\Http\Controllers
 * @author Lyon Palme Development Team
 * @version 1.0
 */

namespace App\Http\Controllers;

use App\Models\Seance;
use App\Models\Entrainement;
use Illuminate\Http\Request;

class SeanceController extends Controller
{
    /**
     * Affiche la liste chronologique de toutes les séances
     * 
     * Récupère toutes les séances avec leurs entraînements et entraîneurs associés,
     * les trie par date décroissante puis par heure de début, et les pagine.
     * 
     * @return \Illuminate\Contracts\View\View Vue avec liste des séances paginée
     */
    public function index()
    {
        $seances = Seance::with('entrainement.entraineur')
                        ->orderBy('date_seance', 'desc')
                        ->orderBy('heure_debut', 'desc')
                        ->paginate(10);
        
        return view('seances.index', compact('seances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $entrainements = Entrainement::with('entraineur')->get();
        return view('seances.create', compact('entrainements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_seance' => 'required|date',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
            'description' => 'nullable|string',
            'entrainement_id' => 'required|exists:entrainement,id'
        ]);

        Seance::create($validated);

        return redirect()->route('seances.index')
                        ->with('success', 'Séance créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Seance $seance)
    {
        $seance->load('entrainement.entraineur');
        
        return view('seances.show', compact('seance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seance $seance)
    {
        $entrainements = Entrainement::with('entraineur')->get();
        return view('seances.edit', compact('seance', 'entrainements'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seance $seance)
    {
        $validated = $request->validate([
            'date_seance' => 'required|date',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
            'description' => 'nullable|string',
            'entrainement_id' => 'required|exists:entrainement,id'
        ]);

        $seance->update($validated);

        return redirect()->route('seances.index')
                        ->with('success', 'Séance mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seance $seance)
    {
        $seance->delete();

        return redirect()->route('seances.index')
                        ->with('success', 'Séance supprimée avec succès.');
    }
}
