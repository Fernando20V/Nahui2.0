<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Shape
 *
 * @property $id
 * @property $route_id
 * @property $path
 * @property $length_km
 * @property $is_primary
 * @property $created_at
 * @property $updated_at
 *
 * @property BusRoute $busRoute
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Shape extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['route_id', 'path', 'length_km', 'is_primary'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function busRoute()
    {
        return $this->belongsTo(\App\Models\BusRoute::class, 'route_id', 'id');
    }
    
}
