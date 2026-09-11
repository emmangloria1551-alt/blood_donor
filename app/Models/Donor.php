<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donor extends Model
{
     use HasFactory;

    protected $fillable = [
        'user_id',
        'blood_type',
        'last_donation',
        'availability',
    ];

    protected $casts = [
        'last_donation' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
