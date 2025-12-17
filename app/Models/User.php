<?php

/**
 * Modèle Utilisateur - Lyon Palme
 * 
 * Représente un utilisateur du système de gestion du club de natation Lyon Palme.
 * Étend la classe User Laravel avec des fonctionnalités spécifiques au club comme
 * la gestion des rôles (président, responsable planning, entraîneur, membre).
 * 
 * Attributs principaux:
 * - Informations personnelles: nom, prénom, email
 * - Système d'authentification sécurisé avec mot de passe hashé
 * - Association à un rôle définissant les permissions
 * - Timestamps de création et modification automatiques
 * 
 * Relations:
 * - belongsTo Role: Rôle assigné à l'utilisateur
 * 
 * Méthodes utilitaires:
 * - hasRole(): Vérification d'un rôle spécifique
 * - hasAnyRole(): Vérification de multiples rôles possibles
 * 
 * @package App\Models
 * @author Lyon Palme Development Team
 * @version 1.0
 */

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'first_name',
        'last_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relation avec le rôle de l'utilisateur
     * 
     * Définit la relation belongsTo avec le modèle Role pour associer
     * chaque utilisateur à son rôle dans le club (président, entraîneur, etc.).
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Vérifie si l'utilisateur possède un rôle spécifique
     * 
     * Méthode utilitaire pour contrôler les permissions et l'accès
     * aux fonctionnalités selon le rôle de l'utilisateur.
     * 
     * @param string $roleName Le nom du rôle à vérifier
     * @return bool True si l'utilisateur a ce rôle, false sinon
     */
    public function hasRole($roleName)
    {
        return $this->role && $this->role->nom_role === $roleName;
    }

    /**
     * Vérifie si l'utilisateur possède au moins un des rôles spécifiés
     * 
     * Méthode flexible permettant de vérifier plusieurs rôles simultanément.
     * Utile pour les permissions qui s'appliquent à plusieurs types d'utilisateurs.
     * 
     * @param string|array $roles Rôle unique (string) ou liste de rôles (array)
     * @return bool True si l'utilisateur a au moins un des rôles, false sinon
     */
    public function hasAnyRole($roles)
    {
        if (!$this->role) return false;
        
        if (is_string($roles)) {
            return $this->role->nom_role === $roles;
        }
        
        if (is_array($roles)) {
            return in_array($this->role->nom_role, $roles);
        }
        
        return false;
    }

    /**
     * Vérifie si l'utilisateur peut gérer les séances (créer, modifier, supprimer)
     * 
     * @return bool
     */
    public function canManageSeances()
    {
        return $this->hasAnyRole(['president', 'responsable_planning']);
    }

    /**
     * Vérifie si l'utilisateur peut gérer les entraînements
     * 
     * @return bool
     */
    public function canManageEntrainements()
    {
        return $this->hasAnyRole(['president', 'responsable_planning', 'entraineur']);
    }

    /**
     * Vérifie si l'utilisateur peut gérer les membres du club
     * 
     * @return bool
     */
    public function canManageMembers()
    {
        return $this->hasAnyRole(['president', 'responsable_planning']);
    }

    /**
     * Vérifie si l'utilisateur peut voir les statistiques complètes
     * 
     * @return bool
     */
    public function canViewFullStats()
    {
        return $this->hasAnyRole(['president', 'responsable_planning']);
    }

    /**
     * Vérifie si l'utilisateur peut supprimer des éléments
     * 
     * @return bool
     */
    public function canDelete()
    {
        return $this->hasRole('president');
    }
}
