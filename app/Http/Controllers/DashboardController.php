<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entraineur;
use App\Models\Adherent;
use App\Models\Entrainement;
use App\Models\Seance;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'trainers' => Entraineur::count(),
            'members' => Adherent::count(),
            'trainings' => Entrainement::count(),
            'sessions' => Seance::count(),
        ];

        // Get upcoming sessions
        $upcomingSessions = Seance::with(['entrainement.entraineur'])
            ->where('dateSeance', '>=', now()->format('Y-m-d'))
            ->orderBy('dateSeance', 'asc')
            ->orderBy('heureDebut', 'asc')
            ->limit(5)
            ->get();

        // Get recent trainings
        $recentTrainings = Entrainement::with('entraineur')
            ->orderBy('dateCreation', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'upcomingSessions', 'recentTrainings'));
    }
}
