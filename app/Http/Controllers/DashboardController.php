<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Planning;
use App\Models\Training;
use App\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->load('roles'); // Charger les rôles

        // Statistiques générales
        $stats = [
            'users_count' => User::count(),
            'plannings_count' => Planning::count(),
            'trainings_count' => Training::count(),
        ];

        // Données spécifiques selon le rôle
        $dashboardData = [];
        
        if ($user->hasRole('admin')) {
            $dashboardData = $this->getAdminDashboard();
        } elseif ($user->hasRole('responsable')) {
            $dashboardData = $this->getResponsableDashboard($user);
        } elseif ($user->hasRole('coach')) {
            $dashboardData = $this->getCoachDashboard($user);
        } else {
            $dashboardData = $this->getAdherentDashboard($user);
        }

        return view('dashboard', compact('stats', 'dashboardData', 'user'));
    }

    private function getAdminDashboard()
    {
        return [
            'title' => 'Administration du Club',
            'recent_users' => User::with('roles')->latest()->limit(5)->get(),
            'recent_plannings' => Planning::latest()->limit(5)->get(),
            'user_roles' => Role::withCount('users')->get(),
            'actions' => [
                ['title' => 'Gestion Utilisateurs', 'route' => 'users.index', 'icon' => '👥', 'description' => 'Gérer tous les membres'],
                ['title' => 'Gestion Plannings', 'route' => 'plannings.index', 'icon' => '📅', 'description' => 'Organiser les séances'],
                ['title' => 'Gestion Entraînements', 'route' => 'trainings.index', 'icon' => '🏊', 'description' => 'Bibliothèque d\'exercices'],
                ['title' => 'Nouveau Utilisateur', 'route' => 'users.create', 'icon' => '➕', 'description' => 'Ajouter un membre'],
            ]
        ];
    }

    private function getResponsableDashboard($user)
    {
        return [
            'title' => 'Espace Responsable',
            'my_plannings' => Planning::latest()->limit(8)->get(),
            'recent_inscriptions' => Planning::with(['users' => function($query) {
                $query->latest('user_planning.created_at')->limit(10);
            }])->get()->flatMap->users->take(10),
            'actions' => [
                ['title' => 'Mes Plannings', 'route' => 'plannings.index', 'icon' => '📋', 'description' => 'Voir les séances'],
                ['title' => 'Nouveau Planning', 'route' => 'plannings.create', 'icon' => '📅', 'description' => 'Créer une séance'],
                ['title' => 'Entraînements', 'route' => 'trainings.index', 'icon' => '🏊', 'description' => 'Exercices disponibles'],
                ['title' => 'Adhérents', 'route' => 'users.index', 'icon' => '👥', 'description' => 'Liste des membres'],
            ]
        ];
    }

    private function getCoachDashboard($user)
    {
        return [
            'title' => 'Espace Coach',
            'my_trainings' => Training::where('created_by', $user->id)->latest()->limit(5)->get(),
            'upcoming_plannings' => Planning::where('date', '>=', now())->orderBy('date')->limit(5)->get(),
            'actions' => [
                ['title' => 'Mes Entraînements', 'route' => 'trainings.index', 'icon' => '🏊', 'description' => 'Mes exercices'],
                ['title' => 'Nouvel Entraînement', 'route' => 'trainings.create', 'icon' => '➕', 'description' => 'Créer un exercice'],
                ['title' => 'Plannings', 'route' => 'plannings.index', 'icon' => '📅', 'description' => 'Séances programmées'],
                ['title' => 'Adhérents', 'route' => 'users.index', 'icon' => '👥', 'description' => 'Voir les membres'],
            ]
        ];
    }

    private function getAdherentDashboard($user)
    {
        return [
            'title' => 'Mon Espace Adhérent',
            'my_plannings' => $user->plannings()->where('date', '>=', now())->orderBy('date')->limit(5)->get(),
            'available_plannings' => Planning::where('date', '>=', now())
                ->whereDoesntHave('users', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->orderBy('date')->limit(5)->get(),
            'actions' => [
                ['title' => 'Mes Inscriptions', 'route' => 'plannings.index', 'icon' => '📋', 'description' => 'Mes séances'],
                ['title' => 'S\'inscrire', 'route' => 'plannings.index', 'icon' => '➕', 'description' => 'Nouvelle séance'],
                ['title' => 'Entraînements', 'route' => 'trainings.index', 'icon' => '🏊', 'description' => 'Exercices disponibles'],
                ['title' => 'Mon Profil', 'route' => 'profile.show', 'icon' => '👤', 'description' => 'Mes informations'],
            ]
        ];
    }
}
