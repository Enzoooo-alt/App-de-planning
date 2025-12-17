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
            'seances_ce_mois' => Seance::whereMonth('date_seance', now()->month)
                                     ->whereYear('date_seance', now()->year)
                                     ->count(),
        ];

        // Ajout de données spécifiques selon le rôle
        switch ($userRole) {
            case 'president':
            case 'responsable_planning':
                // Accès complet aux statistiques administratives
                $stats = array_merge($stats, [
                    'total_membres' => User::count(),
                    'total_entraineurs' => Entraineur::count(),
                ]);
                break;
                
            case 'entraineur':
                // Statistiques personnelles de l'entraîneur
                $entraineur = Entraineur::where('user_id', $user->id)->first();
                if ($entraineur) {
                    $stats['mes_entrainements'] = $entraineur->entrainements()->count();
                    $stats['mes_seances'] = Seance::whereHas('entrainement.entraineur', function($q) use ($user) {
                        $q->where('user_id', $user->id);
                    })->count();
                }
                break;
                
            default: // membre
                // Statistiques limitées pour les membres
                $stats['mes_seances'] = 0; // À implémenter : séances auxquelles il participe
                $stats['mes_entrainements'] = 0; // À implémenter : programmes suivis
                break;
        }

        // Données spécifiques selon le rôle de l'utilisateur connecté
        $roleSpecificData = [];
        
        if ($user && $user->role) {
            // Détermination des données à afficher selon le rôle
            switch ($user->role->nom_role) {
                case 'president':
                    $roleSpecificData = $this->getPresidentData();
                    break;
                case 'responsable_planning':
                    $roleSpecificData = $this->getResponsablePlanningData();
                    break;
                case 'entraineur':
                    $roleSpecificData = $this->getEntraineurData($user);
                    break;
                case 'membre':
                default:
                    $roleSpecificData = $this->getMembreData($user);
                    break;
            }
        }

        return view('dashboard', compact('stats', 'roleSpecificData', 'user'));
    }

    /**
     * Récupère les données spécifiques au tableau de bord du président
     * 
     * Fournit une vue d'ensemble complète du club avec les activités récentes,
     * la répartition des membres par rôle et les statistiques globales.
     * 
     * @return array Données pour le tableau de bord président
     */
    private function getPresidentData()
    {
        return [
            'recent_activities' => [
                'nouveaux_membres_semaine' => User::where('created_at', '>=', now()->subWeek())->count(),
                'entrainements_actifs' => Entrainement::whereHas('seances', function($query) {
                    $query->where('date_seance', '>=', now());
                })->count(),
            ],
            'members_by_role' => Role::withCount('users')->get(),
        ];
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
