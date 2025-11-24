<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'birth_date',
        'address',
        'telephone',
        'date_naissance',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birth_date' => 'date',
            'date_naissance' => 'date',
        ];
    }

    /**
     * Relations
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function plannings()
    {
        return $this->belongsToMany(Planning::class, 'user_planning')->withPivot('registration_date', 'status')->withTimestamps();
    }

    public function trainings()
    {
        return $this->hasMany(Training::class, 'created_by');
    }

    /**
     * Helper methods
     */
    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    public function isCoach()
    {
        return $this->hasRole('coach');
    }

    public function isResponsable()
    {
        return $this->hasRole('responsable');
    }
}
