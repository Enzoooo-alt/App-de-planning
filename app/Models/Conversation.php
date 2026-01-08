<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['titre', 'is_groupe'];

    protected $casts = [
        'is_groupe' => 'boolean'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class)->orderBy('created_at', 'asc');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'conversation_user')
            ->withPivot('derniere_lecture')
            ->withTimestamps();
    }

    public function dernierMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }
}
