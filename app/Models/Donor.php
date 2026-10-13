<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Donor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'blood_type',
        'phone',
        'address',
        'last_donation',
        'availability',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'last_donation' => 'date',
            'is_active' => 'boolean',
        ];
    }

    /**
     * A donor profile belongs to one user account.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}