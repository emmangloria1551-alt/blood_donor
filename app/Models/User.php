<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Donor;
use App\Models\Appointment;
use App\Models\BloodRequest;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'blood_type',
        'role',
        'status',
        'address',
        'contact_number',
        'availability',
    ];

    /**
     * Hidden attributes.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * A user can have one donor profile.
     */
    public function donor()
    {
        return $this->hasOne(Donor::class, 'user_id');
    }

    /**
     * A user can have many appointments.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'user_id');
    }

    /**
     * A user can have many blood requests.
     */
    public function bloodRequests()
    {
        return $this->hasMany(BloodRequest::class, 'user_id');
    }
}