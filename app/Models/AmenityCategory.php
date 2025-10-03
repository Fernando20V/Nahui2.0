<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AmenityCategory
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property Amenity[] $amenities
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AmenityCategory extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function amenities()
    {
        return $this->hasMany(\App\Models\Amenity::class, 'id', 'amenity_category_id');
    }
    
}
