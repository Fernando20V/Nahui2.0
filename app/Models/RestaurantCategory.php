<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RestaurantCategory
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property Restaurant[] $restaurants
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class RestaurantCategory extends Model
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
    public function restaurants()
    {
        return $this->hasMany(\App\Models\Restaurant::class, 'id', 'restaurant_category_id');
    }
    
}
