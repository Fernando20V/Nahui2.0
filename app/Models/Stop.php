<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Stop
 *
 * @property $id
 * @property $name
 * @property $municipality_id
 * @property $address_id
 * @property $place_id
 * @property $lat
 * @property $lng
 * @property $is_terminal
 * @property $is_active
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Address $address
 * @property Municipality $municipality
 * @property Place $place
 * @property BusRoute[] $busRoutes
 * @property BusRoute[] $busRoutes
 * @property RouteStop[] $routeStops
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Stop extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'municipality_id', 'address_id', 'place_id', 'lat', 'lng', 'is_terminal', 'is_active'];


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
    public function municipality()
    {
        return $this->belongsTo(\App\Models\Municipality::class, 'municipality_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place()
    {
        return $this->belongsTo(\App\Models\Place::class, 'place_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function busRoutes()
    {
        return $this->hasMany(\App\Models\BusRoute::class, 'id', 'destination_stop_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function busRoute()
    {
        return $this->hasMany(\App\Models\BusRoute::class, 'id', 'origin_stop_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function routeStops()
    {
        return $this->hasMany(\App\Models\RouteStop::class, 'id', 'stop_id');
    }
    
}
