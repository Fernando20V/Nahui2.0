<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrganizationRoute
 *
 * @property $id
 * @property $organization_id
 * @property $route_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Organization $organization
 * @property BusRoute $busRoute
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class OrganizationRoute extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['organization_id', 'route_id'];


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
    public function busRoute()
    {
        return $this->belongsTo(\App\Models\BusRoute::class, 'route_id', 'id');
    }
    
}
