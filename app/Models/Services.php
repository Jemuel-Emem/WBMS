<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
 protected $fillable = [
    'name',
    'price',
    'description',
];

public function bookings()
{
    return $this->hasMany(Booking::class);
}

  public function ratings()
    {
        return $this->hasManyThrough(Rating::class, Booking::class, 'service_id', 'booking_id');
    }
}
