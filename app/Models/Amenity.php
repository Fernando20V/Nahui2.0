<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Amenity
 *
 * @property $id
 * @property $amenity_category_id
 * @property $name
 * @property $icon
 * @property $created_at
 * @property $updated_at
 *
 * @property AmenityCategory $amenityCategory
 * @property AccommodationAmenity[] $accommodationAmenities
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Amenity extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['amenity_category_id', 'name', 'icon'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function amenityCategory()
    {
        return $this->belongsTo(\App\Models\AmenityCategory::class, 'amenity_category_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accommodationAmenities()
    {
        return $this->hasMany(\App\Models\AccommodationAmenity::class, 'id', 'amenity_id');
    }
    
}
