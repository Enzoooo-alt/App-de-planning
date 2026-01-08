<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'adherent_id',
        'montant',
        'type',
        'methode',
        'statut',
        'date_paiement',
        'saison',
        'recu_numero',
        'note'
    ];

    protected $casts = [
        'date_paiement' => 'date',
        'montant' => 'decimal:2'
    ];

    public function adherent()
    {
        return $this->belongsTo(Adherent::class);
    }

    public function getTypeLabelAttribute()
    {
        return match($this->type) {
            'cotisation_annuelle' => '💰 Cotisation annuelle',
            'stage' => '🏊 Stage',
            'competition' => '🏆 Compétition',
            'equipement' => '👕 Équipement',
            'autre' => '📋 Autre',
            default => $this->type,
        };
    }

    public function getStatutBadgeAttribute()
    {
        return match($this->statut) {
            'valide' => '<span class="badge badge-success">✓ Validé</span>',
            'en_attente' => '<span class="badge badge-warning">⏳ En attente</span>',
            'refuse' => '<span class="badge badge-danger">✗ Refusé</span>',
            'rembourse' => '<span class="badge badge-secondary">↩ Remboursé</span>',
            default => '<span class="badge badge-secondary">? Inconnu</span>',
        };
    }

    public function getMethodeLabelAttribute()
    {
        return match($this->methode) {
            'especes' => '💵 Espèces',
            'cheque' => '📝 Chèque',
            'virement' => '🏦 Virement',
            'carte_bancaire' => '💳 Carte bancaire',
            'cb' => '💳 Carte bancaire',
            'en_ligne' => '🌐 Paiement en ligne',
            'autre' => '📋 Autre',
            default => $this->methode,
        };
    }
}
