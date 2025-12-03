<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adherent extends Model
{
    protected $table = 'ADHERENT';
    protected $primaryKey = 'idAdherent';
    public $timestamps = false;
    
    protected $fillable = [
        'nom', 'prenom', 'profession', 'mail', 'telephone', 'adresse', 'login', 'mot_de_passe'
    ];

    protected $hidden = [
        'mot_de_passe',
    ];
}
