<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DishRestaurant
 *
 * @property $restaurant_id
 * @property $dish_id
 * @property $price
 * @property $currency
 * @property $created_at
 * @property $updated_at
 *
 * @property Dish $dish
 * @property Restaurant $restaurant
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DishRestaurant extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['restaurant_id', 'dish_id', 'price', 'currency'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dish()
    {
        return $this->belongsTo(\App\Models\Dish::class, 'dish_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restaurant()
    {
        return $this->belongsTo(\App\Models\Restaurant::class, 'restaurant_id', 'id');
    }
    
}
