<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActualiteController extends Controller
{
    /**
     * Display a listing of actualites
     */
    public function index()
    {
        $actualites = Actualite::with('user')
            ->publie()
            ->latest('publie_le')
            ->paginate(12);
        
        $epinglees = Actualite::with('user')
            ->publie()
            ->epingle()
            ->latest('publie_le')
            ->take(3)
            ->get();
        
        return view('actualites.index-v2', compact('actualites', 'epinglees'));
    }

    /**
     * Show the form for creating a new actualite
     */
    public function create()
    {
        return view('actualites.create-v2');
    }

    /**
     * Store a newly created actualite
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categorie' => 'required|in:competition,evenement,info,resultat',
            'statut' => 'required|in:brouillon,publie',
            'epingle' => 'boolean',
        ]);

        $validated['user_id'] = auth()->id();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('actualites', 'public');
        }
        
        // Set publie_le if publishing
        if ($validated['statut'] === 'publie') {
            $validated['publie_le'] = now();
        }
        
        $validated['epingle'] = $request->has('epingle');

        $actualite = Actualite::create($validated);

        return redirect()->route('actualites.index')
            ->with('success', 'Actualité créée avec succès !');
    }

    /**
     * Display the specified actualite
     */
    public function show(Actualite $actualite)
    {
        // Only show published actualites to non-admins
        if ($actualite->statut !== 'publie' && !auth()->user()->hasAnyRole(['president', 'responsable_planning'])) {
            abort(404);
        }
        
        $actualite->load('user');
        
        // Get related actualites
        $relatedActualites = Actualite::publie()
            ->where('id', '!=', $actualite->id)
            ->where('categorie', $actualite->categorie)
            ->latest('publie_le')
            ->take(3)
            ->get();
        
        return view('actualites.show-v2', compact('actualite', 'relatedActualites'));
    }

    /**
     * Show the form for editing the specified actualite
     */
    public function edit(Actualite $actualite)
    {
        return view('actualites.edit-v2', compact('actualite'));
    }

    /**
     * Update the specified actualite
     */
    public function update(Request $request, Actualite $actualite)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categorie' => 'required|in:competition,evenement,info,resultat',
            'statut' => 'required|in:brouillon,publie',
            'epingle' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($actualite->image) {
                Storage::disk('public')->delete($actualite->image);
            }
            $validated['image'] = $request->file('image')->store('actualites', 'public');
        }
        
        // Set publie_le if publishing for first time
        if ($validated['statut'] === 'publie' && $actualite->statut === 'brouillon') {
            $validated['publie_le'] = now();
        }
        
        $validated['epingle'] = $request->has('epingle');

        $actualite->update($validated);

        return redirect()->route('actualites.index')
            ->with('success', 'Actualité mise à jour avec succès !');
    }

    /**
     * Remove the specified actualite
     */
    public function destroy(Actualite $actualite)
    {
        // Delete image if exists
        if ($actualite->image) {
            Storage::disk('public')->delete($actualite->image);
        }
        
        $actualite->delete();

        return redirect()->route('actualites.index')
            ->with('success', 'Actualité supprimée avec succès !');
    }

    /**
     * Liste all actualites (including drafts) for admins
     */
    public function manage()
    {
        $actualites = Actualite::with('user')
            ->latest('created_at')
            ->paginate(15);
        
        $stats = [
            'total' => Actualite::count(),
            'publies' => Actualite::where('statut', 'publie')->count(),
            'brouillons' => Actualite::where('statut', 'brouillon')->count(),
            'epinglees' => Actualite::where('epingle', true)->count(),
        ];
        
        return view('actualites.manage-v2', compact('actualites', 'stats'));
    }
}
