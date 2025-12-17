<?php

/**
 * Contrôleur de gestion des entraîneurs - Lyon Palme
 * 
 * Gère toutes les opérations CRUD pour les entraîneurs du club de natation.
 * Permet la gestion complète du personnel d'encadrement avec leurs
 * informations personnelles, spécialités et programmes assignés.
 * 
 * Fonctionnalités:
 * - Gestion des profils entraîneurs et de leurs spécialités
 * - Attribution et suivi des programmes d'entraînement
 * - Gestion des identifiants de connexion spécifiques
 * - Interface de consultation avec programmes associés
 * - Contrôle des permissions et accès selon les rôles
 * 
 * @package App\Http\Controllers
 * @author Lyon Palme Development Team
 * @version 1.0
 */

namespace App\Http\Controllers;

use App\Models\Entraineur;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entraineurs = Entraineur::with('entrainements')->latest()->paginate(10);
        
        return view('entraineurs.index', compact('entraineurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('entraineurs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'login' => 'required|string|unique:entraineur,login|max:255',
            'mot_de_passe' => 'required|string|min:6'
        ]);

        $validated['mot_de_passe'] = bcrypt($validated['mot_de_passe']);

        Entraineur::create($validated);

        return redirect()->route('entraineurs.index')
                        ->with('success', 'Entraîneur créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Entraineur $entraineur)
    {
        $entraineur->load('entrainements.seances');
        
        return view('entraineurs.show', compact('entraineur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entraineur $entraineur)
    {
        return view('entraineurs.edit', compact('entraineur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entraineur $entraineur)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'login' => 'required|string|max:255|unique:entraineur,login,' . $entraineur->id,
            'mot_de_passe' => 'nullable|string|min:6'
        ]);

        if ($validated['mot_de_passe']) {
            $validated['mot_de_passe'] = bcrypt($validated['mot_de_passe']);
        } else {
            unset($validated['mot_de_passe']);
        }

        $entraineur->update($validated);

        return redirect()->route('entraineurs.index')
                        ->with('success', 'Entraîneur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entraineur $entraineur)
    {
        $entraineur->delete();

        return redirect()->route('entraineurs.index')
                        ->with('success', 'Entraîneur supprimé avec succès.');
    }
}