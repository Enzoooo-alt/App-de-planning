<?php

/**
 * Modèle Entraînement - Lyon Palme
 * 
 * Représente un programme d'entraînement du club de natation Lyon Palme.
 * Chaque entraînement est défini par un titre, une description et est assigné
 * à un entraîneur spécifique. Il peut avoir plusieurs séances planifiées.
 * 
 * Attributs:
 * - titre: Nom du programme d'entraînement (ex: "Perfectionnement Brasse")
 * - description: Description détaillée des objectifs et exercices
 * - entraineur_id: Référence vers l'entraîneur responsable
 * 
 * Relations:
 * - belongsTo Entraineur: Entraîneur responsable du programme
 * - hasMany Seance: Séances planifiées pour cet entraînement
 * - hasMany Commentaire: Retours des adhérents sur l'entraînement
 * 
 * @package App\Models
 * @author Lyon Palme Development Team
 * @version 1.0
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrainement extends Model
{
    protected $table = 'entrainement';
    
    protected $fillable = [
        'titre', 'description', 'entraineur_id', 'niveau', 'objectifs'
    ];

    /**
     * Relation avec l'entraîneur responsable
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entraineur()
    {
        return $this->belongsTo(Entraineur::class, 'entraineur_id');
    }

    /**
     * Relation avec les séances de cet entraînement
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seances()
    {
        return $this->hasMany(Seance::class, 'entrainement_id');
    }

    /**
     * Relation avec les commentaires sur cet entraînement
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'entrainement_id');
    }
}
