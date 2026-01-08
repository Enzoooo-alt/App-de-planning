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
     * Relation avec le rôle principal de l'utilisateur (legacy - pour compatibilité)
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relation avec tous les rôles de l'utilisateur (système de rôles multiples)
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user')->withTimestamps();
    }

    /**
     * Relation avec le profil adhérent de l'utilisateur (optionnel)
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function adherent()
    {
        return $this->hasOne(Adherent::class);
    }

    /**
     * Vérifie si l'utilisateur possède un rôle spécifique
     * Support des rôles multiples via la table pivot
     * 
     * @param string $roleName Le nom du rôle à vérifier
     * @return bool True si l'utilisateur a ce rôle, false sinon
     */
    public function hasRole($roleName)
    {
        // Vérifier dans les rôles multiples (prioritaire)
        if ($this->roles()->where('nom_role', $roleName)->exists()) {
            return true;
        }
        
        // Fallback sur le rôle principal (legacy)
        return $this->role && $this->role->nom_role === $roleName;
    }

    /**
     * Vérifie si l'utilisateur possède au moins un des rôles spécifiés
     * Support des rôles multiples
     * 
     * @param string|array $roles Rôle unique (string) ou liste de rôles (array)
     * @return bool True si l'utilisateur a au moins un des rôles, false sinon
     */
    public function hasAnyRole($roles)
    {
        $roles = is_array($roles) ? $roles : [$roles];
        
        // Vérifier dans les rôles multiples (prioritaire)
        if ($this->roles()->whereIn('nom_role', $roles)->exists()) {
            return true;
        }
        
        // Fallback sur le rôle principal (legacy)
        if ($this->role && in_array($this->role->nom_role, $roles)) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Obtenir tous les noms de rôles de l'utilisateur
     * 
     * @return array
     */
    public function getRoleNames()
    {
        $roleNames = $this->roles->pluck('nom_role')->toArray();
        
        // Ajouter le rôle principal si présent
        if ($this->role && !in_array($this->role->nom_role, $roleNames)) {
            $roleNames[] = $this->role->nom_role;
        }
        
        return $roleNames;
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

    /**
     * Relation avec les conversations de l'utilisateur
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversation_user')
            ->withPivot('derniere_lecture')
            ->withTimestamps();
    }

    /**
     * Relation avec les messages envoyés par l'utilisateur
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Relation avec les documents uploadés par l'utilisateur
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documentsUploaded()
    {
        return $this->hasMany(Document::class, 'upload_par');
    }
}
