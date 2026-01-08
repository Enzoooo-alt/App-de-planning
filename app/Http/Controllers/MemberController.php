<?php

/**
 * Contrôleur de gestion des membres (adhérents) - Lyon Palme
 * 
 * Gère toutes les opérations CRUD pour les adhérents du club de natation.
 * Permet la gestion complète des informations des membres, leur inscription,
 * modification de profil et suivi de leur activité dans le club.
 * 
 * Fonctionnalités:
 * - Gestion des inscriptions et informations personnelles
 * - Suivi du niveau de natation et de l'activité
 * - Gestion des coordonnées et informations de contact
 * - Contrôle du statut d'adhésion (actif/inactif)
 * - Interface de consultation pour les responsables
 * 
 * @package App\Http\Controllers
 * @author Lyon Palme Development Team
 * @version 1.0
 */

namespace App\Http\Controllers;

use App\Models\Adherent;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adherents = Adherent::with('user')->latest()->paginate(15);
        
        // Statistiques pour le dashboard
        $stats = [
            'actifs' => Adherent::where('actif', true)->count(),
            'avec_niveau' => Adherent::whereNotNull('niveau')->count(),
            'avec_email' => Adherent::whereNotNull('email')->count(),
        ];
        
        return view('adherents.index-v2', compact('adherents', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = \App\Models\User::whereDoesntHave('adherent')->get();
        return view('adherents.create-v2', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:adherent,email',
            'telephone' => 'nullable|string|max:20',
            'date_adhesion' => 'required|date',
            'niveau' => 'nullable|in:debutant,intermediaire,avance,competition',
            'user_id' => 'nullable|exists:users,id',
            'actif' => 'boolean'
        ]);

        $validated['actif'] = $request->has('actif') ? 1 : 0;

        Adherent::create($validated);

        return redirect()->route('adherents.index')
                        ->with('success', 'Adhérent inscrit avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Adherent $adherent)
    {
        $adherent->load('commentaires.entrainement');
        
        return view('adherents.show', compact('adherent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Adherent $adherent)
    {
        $users = \App\Models\User::whereDoesntHave('adherent')
                                 ->orWhere('id', $adherent->user_id)
                                 ->get();
        return view('adherents.edit-v2', compact('adherent', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Adherent $adherent)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:adherent,email,' . $adherent->id,
            'telephone' => 'nullable|string|max:20',
            'date_adhesion' => 'required|date',
            'niveau' => 'nullable|in:debutant,intermediaire,avance,competition',
            'user_id' => 'nullable|exists:users,id',
            'actif' => 'boolean'
        ]);

        $validated['actif'] = $request->has('actif') ? 1 : 0;

        $adherent->update($validated);

        return redirect()->route('adherents.index')
                        ->with('success', 'Informations de l\'adhérent mises à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adherent $adherent)
    {
        $adherent->delete();

        return redirect()->route('adherents.index')
                        ->with('success', 'Adhérent supprimé avec succès.');
    }
}