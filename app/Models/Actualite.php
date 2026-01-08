<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Actualite extends Model
{
    protected $fillable = [
        'titre',
        'contenu',
        'image',
        'user_id',
        'categorie',
        'statut',
        'epingle',
        'publie_le',
    ];

    protected $casts = [
        'epingle' => 'boolean',
        'publie_le' => 'datetime',
    ];

    /**
     * Relation avec l'utilisateur (auteur)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope pour les actualités publiées
     */
    public function scopePublie($query)
    {
        return $query->where('statut', 'publie')
                    ->whereNotNull('publie_le')
                    ->where('publie_le', '<=', now());
    }

    /**
     * Scope pour les actualités épinglées
     */
    public function scopeEpingle($query)
    {
        return $query->where('epingle', true);
    }

    /**
     * Get the badge color for category
     */
    public function getCategoryBadgeColorAttribute()
    {
        return match($this->categorie) {
            'competition' => 'danger',
            'evenement' => 'teal',
            'resultat' => 'success',
            default => 'navy',
        };
    }

    /**
     * Get the category label
     */
    public function getCategoryLabelAttribute()
    {
        return match($this->categorie) {
            'competition' => 'Compétition',
            'evenement' => 'Événement',
            'resultat' => 'Résultat',
            default => 'Information',
        };
    }
}
