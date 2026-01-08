<?php

/**
 * Contrôleur du tableau de bord - Lyon Palme
 * 
 * Gère l'affichage du tableau de bord principal selon le rôle de l'utilisateur.
 * Fournit des données statistiques et personnalisées pour chaque type d'utilisateur.
 * 
 * Rôles supportés:
 * - Président: Vue d'ensemble complète du club
 * - Responsable Planning: Gestion des séances et entraînements  
 * - Entraîneur: Planning personnel et disponibilités
 * - Membre: Séances disponibles et historique personnel
 * 
 * @package App\Http\Controllers
 * @author Lyon Palme Development Team
 * @version 1.0
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entraineur;
use App\Models\Adherent;
use App\Models\Entrainement;
use App\Models\Seance;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord principal
     * 
     * Détermine le rôle de l'utilisateur connecté et retourne les données
     * appropriées pour son tableau de bord personnalisé.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $userRole = $user->role ? $user->role->nom_role : 'membre';
        
        // Statistiques de base adaptées selon le rôle
        $stats = [
            'total_seances' => Seance::count(),
            'total_entrainements' => Entrainement::count(),
            'seances_mois' => Seance::whereMonth('date_seance', now()->month)
                                     ->whereYear('date_seance', now()->year)
                                     ->count(),
            'total_adherents' => User::count(),
            'total_entraineurs' => Entraineur::count(),
        ];

        // Ajout de données spécifiques selon le rôle - Utilisation des vues v2
        switch ($userRole) {
            case 'president':
                $data = $this->getPresidentData();
                return view('dashboard.president-v2', compact('data', 'stats'));
            case 'responsable_planning':
                $data = $this->getResponsablePlanningData();
                return view('dashboard.responsable-planning-v2', compact('data', 'stats'));
            case 'entraineur':
                $data = $this->getEntraineurData($user);
                return view('dashboard.entraineur-v2', compact('data', 'stats'));
            case 'membre':
            default:
                $data = $this->getMembreData($user);
                return view('dashboard.membre-v2', compact('data', 'stats'));
        }
    }

    /**
     * Récupère les données spécifiques au tableau de bord du président
     * 
     * Fournit une vue d'ensemble complète du club avec les activités récentes,
     * la répartition des membres par rôle et les statistiques globales.
     * 
     * @return array Données pour le tableau de bord président
     */
    /**
     * Récupère les données spécifiques au tableau de bord président
     * 
     * Affiche une vue d'ensemble complète du club incluant les statistiques globales,
     * les activités récentes et la répartition des membres par rôle.
     * 
     * @return array Données pour le tableau de bord président
     */
    private function getPresidentData()
    {
        return [
            'recent_activities' => $this->getRecentActivities(),
            'members_by_role' => Role::withCount('users')->get(),
            'total_adherents' => User::count(),
            'total_entraineurs' => Entraineur::count(),
            'seances_mois' => Seance::whereMonth('date_seance', now()->month)
                                   ->whereYear('date_seance', now()->year)
                                   ->count(),
            'total_entrainements' => Entrainement::count(),
        ];
    }

    /**
     * Récupère les activités récentes du club
     * 
     * @return array Liste des activités récentes avec type, titre et date
     */
    private function getRecentActivities()
    {
        $activities = [];
        
        // Nouvelles inscriptions
        $newMembers = User::where('created_at', '>=', now()->subWeek())
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();
        
        foreach ($newMembers as $member) {
            $activities[] = [
                'type' => 'adherent',
                'title' => 'Nouveau membre: ' . $member->name,
                'date' => $member->created_at->diffForHumans(),
            ];
        }
        
        // Séances récemment créées
        $newSeances = Seance::where('created_at', '>=', now()->subWeek())
            ->with('entrainement')
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();
        
        foreach ($newSeances as $seance) {
            $activities[] = [
                'type' => 'seance',
                'title' => 'Séance planifiée: ' . ($seance->entrainement->titre ?? 'N/A'),
                'date' => $seance->created_at->diffForHumans(),
            ];
        }
        
        // Nouveaux entraînements
        $newEntrainements = Entrainement::where('created_at', '>=', now()->subWeek())
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();
        
        foreach ($newEntrainements as $entrainement) {
            $activities[] = [
                'type' => 'entrainement',
                'title' => 'Programme créé: ' . $entrainement->titre,
                'date' => $entrainement->created_at->diffForHumans(),
            ];
        }
        
        // Tri par date (plus récent en premier)
        usort($activities, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });
        
        return array_slice($activities, 0, 6);
    }

    /**
     * Récupère les données spécifiques au responsable planning
     * 
     * Affiche les séances de la semaine prochaine et les entraînements
     * qui n'ont pas encore de séances programmées pour faciliter la planification.
     * 
     * @return array Données pour le tableau de bord responsable planning
     */
    private function getResponsablePlanningData()
    {
        return [
            'seances_semaine_prochaine' => Seance::whereBetween('date_seance', [
                now()->startOfWeek()->addWeek(),
                now()->endOfWeek()->addWeek()
            ])->with('entrainement')->get(),
            'entrainements_sans_seance' => Entrainement::doesntHave('seances')
                ->orWhereDoesntHave('seances', function($query) {
                    $query->where('date_seance', '>=', now());
                })->get(),
        ];
    }

    /**
     * Récupère les données spécifiques au tableau de bord entraîneur
     * 
     * Affiche les séances de la semaine courante et les prochaines séances
     * assignées à l'entraîneur pour une gestion optimale de son planning.
     * 
     * @param \App\Models\User $user L'utilisateur entraîneur connecté
     * @return array Données pour le tableau de bord entraîneur
     */
    private function getEntraineurData($user)
    {
        // Logique pour récupérer les données de l'entraîneur
        // Pour l'instant, données génériques
        return [
            'mes_seances_semaine' => Seance::whereBetween('date_seance', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])->with('entrainement')->take(5)->get(),
            'prochaines_seances' => Seance::where('date_seance', '>=', now())
                ->orderBy('date_seance')
                ->take(3)
                ->with('entrainement')
                ->get(),
        ];
    }

    /**
     * Récupère les données spécifiques au tableau de bord membre
     * 
     * Affiche les prochaines séances disponibles pour permettre au membre
     * de consulter facilement le planning des activités du club.
     * 
     * @param \App\Models\User $user L'utilisateur membre connecté
     * @return array Données pour le tableau de bord membre
     */
    private function getMembreData($user)
    {
        return [
            'prochaines_seances' => Seance::where('date_seance', '>=', now())
                ->orderBy('date_seance')
                ->take(5)
                ->with('entrainement')
                ->get(),
        ];
    }
}
