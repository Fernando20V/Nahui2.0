<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RouteStop
 *
 * @property $id
 * @property $route_id
 * @property $stop_id
 * @property $sequence
 * @property $created_at
 * @property $updated_at
 *
 * @property BusRoute $busRoute
 * @property Stop $stop
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class RouteStop extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['route_id', 'stop_id', 'sequence'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function busRoute()
    {
        return $this->belongsTo(\App\Models\BusRoute::class, 'route_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stop()
    {
        return $this->belongsTo(\App\Models\Stop::class, 'stop_id', 'id');
    }
    
}
