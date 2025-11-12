<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    protected $fillable = [
        'date',
        'day',
        'start_time',
        'end_time',
        'coach1',
        'coach2',
        'description',
        'max_participants',
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    /**
     * Relations
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_planning')->withPivot('registration_date', 'status')->withTimestamps();
    }

    /**
     * Helper methods
     */
    public function availableSpots()
    {
        return $this->max_participants - $this->users()->count();
    }

    public function isFull()
    {
        return $this->availableSpots() <= 0;
    }
}
