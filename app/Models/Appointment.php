<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    // Define fillable fields based on database schema
    protected $fillable = [
        'user_id',
        'barber_id',
        'appointmentDate',
        'status',
        'paymentStatus'
    ];

    // Define default values
    protected $attributes = [
        'status' => 'pending',
        'paymentStatus' => 'pending'
    ];

    // Cast dates to Carbon instances
    protected $casts = [
        'appointmentDate' => 'datetime'
    ];

    // Relationship with User (client)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Barber
    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }

    // Relationship with Service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Relationship with Payment
    // public function payment()
    // {
    //     return $this->hasOne(Payment::class);
    // }
}
