<?php

/**
 * Modèle Adhérent - Lyon Palme
 * 
 * Représente un adhérent du club de natation Lyon Palme.
 * Contient toutes les informations personnelles et sportives nécessaires
 * au suivi des membres du club.
 * 
 * Attributs:
 * - nom, prenom: Identité de l'adhérent
 * - email: Adresse email pour communication
 * - password: Mot de passe hashé pour connexion
 * - telephone: Numéro de téléphone de contact
 * - adresse: Adresse postale complète
 * - niveau: Niveau de natation (débutant, intermédiaire, confirmé, etc.)
 * - actif: Statut d'activité de l'adhésion (boolean)
 * - date_naissance: Date de naissance pour calcul d'âge et catégories
 * 
 * Relations:
 * - hasMany Commentaire: Commentaires laissés par cet adhérent
 * 
 * Sécurité et formats:
 * - Mot de passe et token cachés dans les sérialisations
 * - Conversion automatique des dates et booléens
 * 
 * @package App\Models
 * @author Lyon Palme Development Team
 * @version 1.0
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adherent extends Model
{
    protected $table = 'adherent';
    
    protected $fillable = [
        'nom', 'prenom', 'email', 'password', 'telephone', 'adresse', 'niveau', 'actif', 'date_naissance'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'actif' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relation avec les commentaires de cet adhérent
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'adherent_id');
    }
}
