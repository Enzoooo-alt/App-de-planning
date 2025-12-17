<?php

/**
 * Modèle Rôle - Lyon Palme
 * 
 * Représente les différents rôles disponibles dans le système du club de natation.
 * Définit les niveaux de permissions et d'accès aux fonctionnalités selon la 
 * hiérarchie du club.
 * 
 * Rôles disponibles:
 * - president: Accès complet, gestion globale du club
 * - responsable_planning: Gestion des plannings et séances
 * - entraineur: Accès aux entraînements et séances assignés
 * - membre: Consultation des plannings et informations personnelles
 * 
 * Relations:
 * - hasMany User: Utilisateurs ayant ce rôle
 * 
 * @package App\Models
 * @author Lyon Palme Development Team
 * @version 1.0
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'nom_role'
    ];

    /**
     * Relation avec les utilisateurs ayant ce rôle
     * 
     * Définit la relation hasMany avec le modèle User pour récupérer
     * tous les utilisateurs qui possèdent ce rôle spécifique.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
