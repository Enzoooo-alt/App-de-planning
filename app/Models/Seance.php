<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    protected $table = 'SEANCE';
    protected $primaryKey = 'idSeance';
    public $timestamps = false;
    
    protected $fillable = [
        'dateSeance', 'heureDebut', 'heureFin', 'idEntrainement'
    ];

    protected $casts = [
        'dateSeance' => 'date',
        'heureDebut' => 'datetime:H:i:s',
        'heureFin' => 'datetime:H:i:s',
    ];

    public function entrainement()
    {
        return $this->belongsTo(Entrainement::class, 'idEntrainement', 'idEntrainement');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'idSeance', 'idSeance');
    }
}
