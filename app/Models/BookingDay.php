<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BookingDay
 *
 * @property $booking_id
 * @property $accommodation_id
 * @property $day
 *
 * @property Accommodation $accommodation
 * @property Booking $booking
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BookingDay extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['booking_id', 'accommodation_id', 'day'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accommodation()
    {
        return $this->belongsTo(\App\Models\Accommodation::class, 'accommodation_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function booking()
    {
        return $this->belongsTo(\App\Models\Booking::class, 'booking_id', 'id');
    }
    
}
