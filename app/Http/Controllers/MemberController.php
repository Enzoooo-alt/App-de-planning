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
        return view('adherents.create');
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
            'password' => 'required|string|min:6',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
            'niveau' => 'required|in:debutant,intermediaire,avance,expert',
            'date_naissance' => 'nullable|date'
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['actif'] = true;

        Adherent::create($validated);

        return redirect()->route('adherents.index')
                        ->with('success', 'Adhérent créé avec succès.');
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
        return view('adherents.edit', compact('adherent'));
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
            'password' => 'nullable|string|min:6',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
            'niveau' => 'required|in:debutant,intermediaire,avance,expert',
            'date_naissance' => 'nullable|date',
            'actif' => 'boolean'
        ]);

        if ($validated['password']) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $adherent->update($validated);

        return redirect()->route('adherents.index')
                        ->with('success', 'Adhérent mis à jour avec succès.');
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