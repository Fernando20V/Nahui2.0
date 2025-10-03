<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BusRoute
 *
 * @property $id
 * @property $short_name
 * @property $long_name
 * @property $scope
 * @property $service_pattern
 * @property $transport_type_id
 * @property $organization_id
 * @property $origin_stop_id
 * @property $destination_stop_id
 * @property $municipality_id
 * @property $distance_km
 * @property $is_active
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Stop $stop
 * @property Municipality $municipality
 * @property Organization $organization
 * @property Stop $stop
 * @property TransportType $transportType
 * @property OrganizationRoute[] $organizationRoutes
 * @property RouteSchedule[] $routeSchedules
 * @property RouteStop[] $routeStops
 * @property Shape[] $shapes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BusRoute extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['short_name', 'long_name', 'scope', 'service_pattern', 'transport_type_id', 'organization_id', 'origin_stop_id', 'destination_stop_id', 'municipality_id', 'distance_km', 'is_active'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stop()
    {
        return $this->belongsTo(\App\Models\Stop::class, 'destination_stop_id', 'id');
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
    public function organization()
    {
        return $this->belongsTo(\App\Models\Organization::class, 'organization_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stops()
    {
        return $this->belongsTo(\App\Models\Stop::class, 'origin_stop_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transportType()
    {
        return $this->belongsTo(\App\Models\TransportType::class, 'transport_type_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organizationRoutes()
    {
        return $this->hasMany(\App\Models\OrganizationRoute::class, 'id', 'route_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function routeSchedules()
    {
        return $this->hasMany(\App\Models\RouteSchedule::class, 'id', 'route_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function routeStops()
    {
        return $this->hasMany(\App\Models\RouteStop::class, 'id', 'route_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shapes()
    {
        return $this->hasMany(\App\Models\Shape::class, 'id', 'route_id');
    }
    
}
