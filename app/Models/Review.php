<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // Define fillable fields based on database schema
    protected $fillable = [
        'user_id',
        'barber_id',
        'rating',
        'comment'
    ];

    // Cast attributes
    protected $casts = [
        'rating' => 'float'
    ];

    // Relationship with User (reviewer)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Barber
    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }
}