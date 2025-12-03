<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrainement extends Model
{
    protected $table = 'ENTRAINEMENT';
    protected $primaryKey = 'idEntrainement';
    public $timestamps = false;
    
    protected $fillable = [
        'titre', 'dateCreation', 'idEntraineur'
    ];

    protected $casts = [
        'dateCreation' => 'datetime',
    ];

    public function entraineur()
    {
        return $this->belongsTo(Entraineur::class, 'idEntraineur', 'idEntraineur');
    }

    public function seances()
    {
        return $this->hasMany(Seance::class, 'idEntrainement', 'idEntrainement');
    }
}
