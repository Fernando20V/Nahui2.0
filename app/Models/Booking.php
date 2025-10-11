<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    protected $fillable = [
        'user_id',
        'place_id',
        'start_date',
        'end_date',
        'guests',
        'total_price',
        'currency',
        'status',
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el lugar (antes era accommodation)
    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    // Si mantienes días de reserva, ajusta igual
    public function bookingDays()
    {
        return $this->hasMany(BookingDay::class, 'booking_id');
    }
}
