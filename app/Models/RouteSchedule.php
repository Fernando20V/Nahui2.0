<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RouteSchedule
 *
 * @property $id
 * @property $route_id
 * @property $days_mask
 * @property $start_time
 * @property $end_time
 * @property $headway_minutes
 * @property $created_at
 * @property $updated_at
 *
 * @property BusRoute $busRoute
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class RouteSchedule extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['route_id', 'days_mask', 'start_time', 'end_time', 'headway_minutes'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function busRoute()
    {
        return $this->belongsTo(\App\Models\BusRoute::class, 'route_id', 'id');
    }
    
}
