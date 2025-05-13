<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    // Define fillable fields
    protected $fillable = [
        'barber_id',
        'serviceName',
        'description',
        'price',
        'duration'
    ];

    // Relationships
    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
