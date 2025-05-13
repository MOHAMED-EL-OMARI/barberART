<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    // Define fillable fields
    protected $fillable = [
        'bio',
        'experience',
        'location',
        'verified'
    ];

    // Primary key is user_id
    protected $primaryKey = 'id';

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function availability()
    {
        return $this->hasMany(Availability::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
