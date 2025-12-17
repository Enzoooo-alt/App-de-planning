<?php

/**
 * Modèle Commentaire - Lyon Palme
 * 
 * Représente un commentaire laissé par un adhérent sur un programme d'entraînement.
 * Permet aux membres du club de partager leurs retours et impressions
 * sur les différents entraînements proposés.
 * 
 * Attributs:
 * - contenu: Texte du commentaire de l'adhérent
 * - adherent_id: Référence vers l'adhérent auteur du commentaire
 * - entrainement_id: Référence vers l'entraînement commenté
 * 
 * Relations:
 * - belongsTo Adherent: Adhérent qui a écrit le commentaire
 * - belongsTo Entrainement: Entraînement sur lequel porte le commentaire
 * 
 * Utilisation:
 * - Système de feedback pour améliorer les programmes d'entraînement
 * - Communication entre adhérents et entraîneurs
 * - Historique des retours sur les séances
 * 
 * @package App\Models
 * @author Lyon Palme Development Team
 * @version 1.0
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $table = 'commentaire';
    
    protected $fillable = [
        'contenu', 'adherent_id', 'entrainement_id'
    ];

    /**
     * Relation avec l'adhérent auteur du commentaire
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adherent()
    {
        return $this->belongsTo(Adherent::class, 'adherent_id');
    }

    /**
     * Relation avec l'entraînement commenté
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entrainement()
    {
        return $this->belongsTo(Entrainement::class, 'entrainement_id');
    }
}