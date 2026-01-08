<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'fichier',
        'categorie',
        'visible_par',
        'upload_par',
        'telechargements'
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'upload_par');
    }

    public function incrementDownloads()
    {
        $this->increment('telechargements');
    }
}
