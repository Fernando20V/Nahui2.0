<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Booking
 *
 * @property $id
 * @property $user_id
 * @property $accommodation_id
 * @property $start_date
 * @property $end_date
 * @property $guests
 * @property $total_price
 * @property $currency
 * @property $status
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Accommodation $accommodation
 * @property User $user
 * @property BookingDay[] $bookingDays
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Booking extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'accommodation_id', 'start_date', 'end_date', 'guests', 'total_price', 'currency', 'status'];


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
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookingDays()
    {
        return $this->hasMany(\App\Models\BookingDay::class, 'id', 'booking_id');
    }
    
}
