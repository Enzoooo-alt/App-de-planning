<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Planning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainings = Training::with('plannings')->latest()->paginate(12);
        return view('trainings.index', compact('trainings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plannings = Planning::all();
        return view('trainings.create', compact('plannings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:technique,endurance,vitesse,competition',
            'niveau' => 'required|in:debutant,intermediaire,avance,competition',
            'duree_minutes' => 'required|integer|min:15|max:300',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240', // 10MB max
            'planning_ids' => 'array',
            'planning_ids.*' => 'exists:plannings,id'
        ]);

        // Handle file upload
        if ($request->hasFile('pdf_file')) {
            $validated['pdf_path'] = $request->file('pdf_file')->store('trainings', 'public');
        }

        $training = Training::create($validated);

        // Attach plannings
        if ($request->has('planning_ids')) {
            $training->plannings()->attach($request->planning_ids);
        }

        return redirect()->route('trainings.index')->with('success', '🏊‍♂️ Entraînement créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Training $training)
    {
        $training->load('plannings');
        return view('trainings.show', compact('training'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Training $training)
    {
        $plannings = Planning::all();
        $training->load('plannings');
        return view('trainings.edit', compact('training', 'plannings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Training $training)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:technique,endurance,vitesse,competition',
            'niveau' => 'required|in:debutant,intermediaire,avance,competition',
            'duree_minutes' => 'required|integer|min:15|max:300',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'planning_ids' => 'array',
            'planning_ids.*' => 'exists:plannings,id'
        ]);

        // Handle file upload
        if ($request->hasFile('pdf_file')) {
            // Delete old file if exists
            if ($training->pdf_path) {
                Storage::disk('public')->delete($training->pdf_path);
            }
            $validated['pdf_path'] = $request->file('pdf_file')->store('trainings', 'public');
        }

        $training->update($validated);

        // Sync plannings
        $training->plannings()->sync($request->planning_ids ?? []);

        return redirect()->route('trainings.show', $training)->with('success', '🌊 Entraînement mis à jour !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Training $training)
    {
        // Delete file if exists
        if ($training->pdf_path) {
            Storage::disk('public')->delete($training->pdf_path);
        }

        $training->delete();
        return redirect()->route('trainings.index')->with('success', '🗑️ Entraînement supprimé');
    }

    /**
     * Download training PDF
     */
    public function downloadPdf(Training $training)
    {
        if (!$training->pdf_path || !Storage::disk('public')->exists($training->pdf_path)) {
            abort(404, 'Fichier PDF non trouvé');
        }

        return Storage::disk('public')->download($training->pdf_path, $training->title . '.pdf');
    }
}
