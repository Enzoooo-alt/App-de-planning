<?php

/**
 * Modèle Présence - Lyon Palme
 * 
 * Gère les présences des adhérents aux séances d'entraînement.
 * Permet de suivre l'assiduité des membres et de détecter les absences répétées.
 * 
 * Relations:
 * - belongsTo Seance: La séance concernée
 * - belongsTo Adherent: L'adhérent concerné
 * 
 * @package App\Models
 * @author Lyon Palme Development Team
 * @version 1.0
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $fillable = [
        'seance_id',
        'adherent_id',
        'statut',
        'note'
    ];

    /**
     * Relation avec la séance
     */
    public function seance()
    {
        return $this->belongsTo(Seance::class);
    }

    /**
     * Relation avec l'adhérent
     */
    public function adherent()
    {
        return $this->belongsTo(Adherent::class);
    }

    /**
     * Scope pour les présences marquées comme présent
     */
    public function scopePresent($query)
    {
        return $query->where('statut', 'present');
    }

    /**
     * Scope pour les absences
     */
    public function scopeAbsent($query)
    {
        return $query->where('statut', 'absent');
    }

    /**
     * Scope pour les absences excusées
     */
    public function scopeExcuse($query)
    {
        return $query->where('statut', 'excuse');
    }

    /**
     * Accesseur pour obtenir un badge coloré selon le statut
     */
    public function getStatutBadgeAttribute()
    {
        return match($this->statut) {
            'present' => '<span class="badge badge-success">✓ Présent</span>',
            'excuse' => '<span class="badge badge-warning">📋 Excusé</span>',
            'absent' => '<span class="badge badge-danger">✗ Absent</span>',
            default => '<span class="badge badge-secondary">? Inconnu</span>',
        };
    }

    /**
     * Accesseur pour obtenir la couleur du badge selon le statut
     */
    public function getStatutColorAttribute()
    {
        return match($this->statut) {
            'present' => '#10b981',
            'excuse' => '#f59e0b',
            'absent' => '#ef4444',
            default => '#6b7280',
        };
    }
}
