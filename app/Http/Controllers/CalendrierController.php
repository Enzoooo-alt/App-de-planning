<?php

namespace App\Http\Controllers;

use App\Models\Seance;
use App\Models\Entrainement;
use App\Models\Entraineur;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendrierController extends Controller
{
    /**
     * Display the calendar view
     */
    public function index(Request $request)
    {
        // Get the current month and year from request or use current date
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
        
        // Create Carbon instance for the selected month
        $currentDate = Carbon::create($year, $month, 1);
        
        // Get first and last day of the month
        $startDate = $currentDate->copy()->startOfMonth();
        $endDate = $currentDate->copy()->endOfMonth();
        
        // Get seances for the month with relationships
        $seances = Seance::with(['entrainement', 'adherents'])
            ->whereBetween('date_seance', [$startDate, $endDate])
            ->orderBy('date_seance')
            ->orderBy('heure_debut')
            ->get();
        
        // Get stats for the month
        $stats = [
            'total_seances' => $seances->count(),
            'seances_passees' => $seances->where('date_seance', '<', now()->toDateString())->count(),
            'seances_a_venir' => $seances->where('date_seance', '>=', now()->toDateString())->count(),
        ];
        
        // Get filters data
        $entrainements = Entrainement::orderBy('titre')->get();
        $entraineurs = Entraineur::with('user')->orderBy('nom')->get();
        
        // Navigation dates
        $prevMonth = $currentDate->copy()->subMonth();
        $nextMonth = $currentDate->copy()->addMonth();
        
        return view('calendrier.index-v2', compact(
            'seances',
            'currentDate',
            'startDate',
            'endDate',
            'stats',
            'entrainements',
            'entraineurs',
            'prevMonth',
            'nextMonth'
        ));
    }
    
    /**
     * Get events for FullCalendar (API endpoint)
     */
    public function events(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');
        
        $seances = Seance::with(['entrainement', 'adherents'])
            ->whereBetween('date_seance', [$start, $end])
            ->get();
        
        $events = $seances->map(function($seance) {
            return [
                'id' => $seance->id,
                'title' => $seance->entrainement->titre ?? 'Sans programme',
                'start' => $seance->date_seance . 'T' . $seance->heure_debut,
                'end' => $seance->date_seance . 'T' . $seance->heure_fin,
                'url' => route('seances.show', $seance),
                'backgroundColor' => $this->getColorByNiveau($seance->entrainement->niveau ?? null),
                'borderColor' => $this->getColorByNiveau($seance->entrainement->niveau ?? null),
                'extendedProps' => [
                    'lieu' => $seance->lieu,
                    'niveau' => $seance->entrainement->niveau ?? 'N/A',
                    'participants' => $seance->adherents->count(),
                ],
            ];
        });
        
        return response()->json($events);
    }
    
    /**
     * Get color based on niveau
     */
    private function getColorByNiveau($niveau)
    {
        return match($niveau) {
            'Débutant' => '#10b981',     // Green
            'Intermédiaire' => '#f59e0b', // Amber
            'Avancé' => '#ef4444',        // Red
            'Compétition' => '#8b5cf6',   // Purple
            default => '#0d9488',         // Teal
        };
    }
}
