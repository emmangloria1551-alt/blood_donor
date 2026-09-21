<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    protected $fillable = [
        'donor_id',
        'blood_type',
        'units',
        'status',
        'donated_at',
    ];

    protected $casts = [
        'donated_at' => 'datetime',
    ];

    public function donor(): BelongsTo
    {
        return $this->belongsTo(Donor::class);
    }
}