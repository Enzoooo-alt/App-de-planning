<?php

/**
 * Modèle Entraîneur - Lyon Palme
 * 
 * Représente un entraîneur du club de natation Lyon Palme.
 * Chaque entraîneur peut être responsable de plusieurs programmes d'entraînement
 * et possède ses propres identifiants de connexion.
 * 
 * Attributs:
 * - nom: Nom de famille de l'entraîneur
 * - prenom: Prénom de l'entraîneur
 * - role: Rôle/spécialité de l'entraîneur (ex: "Entraîneur principal")
 * - login: Identifiant de connexion unique
 * - mot_de_passe: Mot de passe hashé (caché dans les sérialisations)
 * 
 * Relations:
 * - hasMany Entrainement: Programmes d'entraînement sous sa responsabilité
 * 
 * Sécurité:
 * - Le mot de passe est automatiquement caché lors des sérialisations JSON
 * 
 * @package App\Models
 * @author Lyon Palme Development Team
 * @version 1.0
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entraineur extends Model
{
    protected $table = 'entraineur';
    
    protected $fillable = [
        'nom', 'prenom', 'role', 'login', 'mot_de_passe'
    ];

    protected $hidden = [
        'mot_de_passe',
    ];

    /**
     * Relation avec les programmes d'entraînement
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entrainements()
    {
        return $this->hasMany(Entrainement::class, 'entraineur_id');
    }
}
