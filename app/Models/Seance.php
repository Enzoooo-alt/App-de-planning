<?php

/**
 * Modèle Séance - Lyon Palme
 * 
 * Représente une séance d'entraînement planifiée dans le club de natation.
 * Chaque séance est associée à un programme d'entraînement et définit
 * un créneau précis avec date, heures de début et de fin.
 * 
 * Attributs:
 * - date_seance: Date de la séance (format date)
 * - heure_debut: Heure de début de la séance (format H:i:s)
 * - heure_fin: Heure de fin de la séance (format H:i:s)  
 * - description: Description spécifique à cette séance
 * - entrainement_id: Référence vers le programme d'entraînement
 * 
 * Relations:
 * - belongsTo Entrainement: Programme d'entraînement de cette séance
 * 
 * Casts automatiques:
 * - Conversion des dates et heures en objets Carbon pour faciliter les calculs
 * 
 * @package App\Models
 * @author Lyon Palme Development Team
 * @version 1.0
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    protected $table = 'seance';
    
    protected $fillable = [
        'date_seance', 'lieu', 'heure_debut', 'heure_fin', 'commentaires', 'entrainement_id'
    ];

    protected $casts = [
        'date_seance' => 'date',
        'heure_debut' => 'datetime:H:i:s',
        'heure_fin' => 'datetime:H:i:s',
    ];

    /**
     * Relation avec le programme d'entraînement
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entrainement()
    {
        return $this->belongsTo(Entrainement::class, 'entrainement_id');
    }
}
