<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'niveau',
        'duree_minutes',
        'pdf_path',
        'created_by',
    ];

    /**
     * Relations
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function plannings()
    {
        return $this->belongsToMany(Planning::class);
    }
}
