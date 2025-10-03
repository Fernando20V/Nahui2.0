<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Accommodation
 *
 * @property $id
 * @property $organization_id
 * @property $address_id
 * @property $accommodation_type_id
 * @property $title
 * @property $description
 * @property $size_sqm
 * @property $floors
 * @property $bedrooms
 * @property $bathrooms
 * @property $cats_allowed
 * @property $dogs_allowed
 * @property $base_price
 * @property $currency
 * @property $status
 * @property $posted_at
 * @property $view_count
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property AccommodationType $accommodationType
 * @property Address $address
 * @property Organization $organization
 * @property AccommodationAmenity[] $accommodationAmenities
 * @property AvailabilitySlot[] $availabilitySlots
 * @property BookingDay[] $bookingDays
 * @property Booking[] $bookings
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Accommodation extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['organization_id', 'address_id', 'accommodation_type_id', 'title', 'description', 'size_sqm', 'floors', 'bedrooms', 'bathrooms', 'cats_allowed', 'dogs_allowed', 'base_price', 'currency', 'status', 'posted_at', 'view_count'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accommodationType()
    {
        return $this->belongsTo(\App\Models\AccommodationType::class, 'accommodation_type_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(\App\Models\Address::class, 'address_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo(\App\Models\Organization::class, 'organization_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accommodationAmenities()
    {
        return $this->hasMany(\App\Models\AccommodationAmenity::class, 'id', 'accommodation_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function availabilitySlots()
    {
        return $this->hasMany(\App\Models\AvailabilitySlot::class, 'id', 'accommodation_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookingDays()
    {
        return $this->hasMany(\App\Models\BookingDay::class, 'id', 'accommodation_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany(\App\Models\Booking::class, 'id', 'accommodation_id');
    }
    
}
