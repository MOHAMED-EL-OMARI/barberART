<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    // Define fillable fields
    protected $fillable = [
        'barber_id',
        'day',
        'startTime',
        'endTime'
    ];

    // Cast attributes
    protected $casts = [
        'startTime' => 'datetime',
        'endTime' => 'datetime'
    ];

    // Relationships
    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }
}