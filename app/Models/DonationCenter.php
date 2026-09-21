<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationCenter extends Model
{
    protected $fillable = [
        'name',
        'location',
        'contact_number',
        'opening_time',
        'closing_time',
        'status',
        'description',
    ];
}