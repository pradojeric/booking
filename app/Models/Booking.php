<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bookingInformations()
    {
        return $this->hasMany(BookingInformation::class);
    }

    public function travelFlight()
    {
        return $this->belongsTo(Flight::class, 'travel_flight_id');
    }

    public function backFlight()
    {
        return $this->belongsTo(Flight::class, 'back_flight_id');
    }
}
