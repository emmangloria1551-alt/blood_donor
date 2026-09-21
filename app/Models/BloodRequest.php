<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BloodRequest extends Model
{
    protected $fillable = [
        'user_id',
        'patient_name',
        'blood_type',
        'units_needed',
        'status',
        'hospital',
        'notes',
    ];

    protected $casts = [
        'units_needed' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}