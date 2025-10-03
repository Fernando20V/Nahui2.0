<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AccommodationAmenity
 *
 * @property $accommodation_id
 * @property $amenity_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Accommodation $accommodation
 * @property Amenity $amenity
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AccommodationAmenity extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['accommodation_id', 'amenity_id'];


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
    public function amenity()
    {
        return $this->belongsTo(\App\Models\Amenity::class, 'amenity_id', 'id');
    }
    
}
