<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Address
 *
 * @property $id
 * @property $municipality_id
 * @property $street_address
 * @property $latitude
 * @property $longitude
 * @property $created_at
 * @property $updated_at
 *
 * @property Municipality $municipality
 * @property Accommodation[] $accommodations
 * @property Event[] $events
 * @property Organization[] $organizations
 * @property Place[] $places
 * @property Restaurant[] $restaurants
 * @property Stop[] $stops
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Address extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['municipality_id', 'street_address', 'latitude', 'longitude'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function municipality()
    {
        return $this->belongsTo(\App\Models\Municipality::class, 'municipality_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accommodations()
    {
        return $this->hasMany(\App\Models\Accommodation::class, 'id', 'address_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany(\App\Models\Event::class, 'id', 'address_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organizations()
    {
        return $this->hasMany(\App\Models\Organization::class, 'id', 'address_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function places()
    {
        return $this->hasMany(\App\Models\Place::class, 'id', 'address_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function restaurants()
    {
        return $this->hasMany(\App\Models\Restaurant::class, 'id', 'address_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stops()
    {
        return $this->hasMany(\App\Models\Stop::class, 'id', 'address_id');
    }
    
}
