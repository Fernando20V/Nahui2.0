<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Restaurant
 *
 * @property $id
 * @property $name
 * @property $restaurant_category_id
 * @property $cuisine_types
 * @property $description
 * @property $price_band
 * @property $hours
 * @property $reservations_supported
 * @property $address_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Address $address
 * @property RestaurantCategory $restaurantCategory
 * @property DishRestaurant[] $dishRestaurants
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Restaurant extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'restaurant_category_id', 'cuisine_types', 'description', 'price_band', 'hours', 'reservations_supported', 'address_id'];


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
    public function restaurantCategory()
    {
        return $this->belongsTo(\App\Models\RestaurantCategory::class, 'restaurant_category_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dishRestaurants()
    {
        return $this->hasMany(\App\Models\DishRestaurant::class, 'id', 'restaurant_id');
    }
    
}
