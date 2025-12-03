<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entraineur extends Model
{
    protected $table = 'ENTRAINEUR';
    protected $primaryKey = 'idEntraineur';
    public $timestamps = false;
    
    protected $fillable = [
        'nom', 'prenom', 'role', 'login', 'mot_de_passe'
    ];

    protected $hidden = [
        'mot_de_passe',
    ];

    public function entrainements()
    {
        return $this->hasMany(Entrainement::class, 'idEntraineur', 'idEntraineur');
    }
}
