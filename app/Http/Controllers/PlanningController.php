<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planning;
use App\Models\User;

class PlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plannings = Planning::with('users')->orderBy('date')->get();
        return view('plannings.index', compact('plannings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plannings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('PlanningController store called', ['data' => $request->all()]);
        
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'date' => 'required|date',
                'day' => 'required|string|max:20',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'coach1' => 'required|string|max:255',
                'coach2' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'max_participants' => 'required|integer|min:1|max:50'
            ]);
            
            \Log::info('Planning validation passed', ['validated' => $validated]);

            $planning = Planning::create($validated);
            
            \Log::info('Planning created', ['planning_id' => $planning->id]);

            return redirect()->route('plannings.index')
                ->with('success', 'Planning créé avec succès.');
                
        } catch (\Exception $e) {
            \Log::error('Error creating planning', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->withInput()->withErrors(['error' => 'Erreur lors de la création: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Planning $planning)
    {
        $planning->load('users');
        return view('plannings.show', compact('planning'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Planning $planning)
    {
        return view('plannings.edit', compact('planning'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Planning $planning)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'day' => 'required|string|max:20',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'coach1' => 'required|string|max:255',
            'coach2' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'max_participants' => 'required|integer|min:1|max:50'
        ]);

        $planning->update($validated);

        return redirect()->route('plannings.index')
            ->with('success', 'Planning modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Planning $planning)
    {
        $planning->delete();

        return redirect()->route('plannings.index')
            ->with('success', 'Planning supprimé avec succès.');
    }

    /**
     * Register user for a planning session
     */
    public function register(Planning $planning)
    {
        $user = auth()->user() ?? User::first(); // Temporaire pour les tests

        if ($planning->isFull()) {
            return back()->with('error', 'Ce créneau est complet.');
        }

        if ($planning->users()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Vous êtes déjà inscrit à ce créneau.');
        }

        $planning->users()->attach($user->id);

        return back()->with('success', 'Inscription réussie !');
    }

    /**
     * Unregister user from a planning session
     */
    public function unregister(Planning $planning)
    {
        $user = auth()->user() ?? User::first(); // Temporaire pour les tests

        $planning->users()->detach($user->id);

        return back()->with('success', 'Désinscription réussie !');
    }

    /**
     * Subscribe user to a planning session (alias for register)
     */
    public function subscribe(Planning $planning)
    {
        return $this->register($planning);
    }

    /**
     * Unsubscribe user from a planning session (alias for unregister)
     */
    public function unsubscribe(Planning $planning)
    {
        return $this->unregister($planning);
    }
}
