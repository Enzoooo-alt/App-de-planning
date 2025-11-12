<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = [
        'name',
        'description',
        'date',
        'location',
        'registration_fee',
        'registration_deadline',
        'max_participants',
        'category',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'registration_deadline' => 'date',
        'registration_fee' => 'decimal:2',
    ];

    /**
     * Relations
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_competition')->withPivot('registration_date', 'status')->withTimestamps();
    }

    /**
     * Helper methods
     */
    public function availableSpots()
    {
        return $this->max_participants ? $this->max_participants - $this->users()->count() : null;
    }

    public function isFull()
    {
        return $this->max_participants && $this->availableSpots() <= 0;
    }

    public function isRegistrationOpen()
    {
        return $this->status === 'open' && 
               $this->registration_deadline >= now()->toDateString() &&
               !$this->isFull();
    }
}
