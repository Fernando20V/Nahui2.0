<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TransportType
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property BusRoute[] $busRoutes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TransportType extends Model
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
    public function busRoutes()
    {
        return $this->hasMany(\App\Models\BusRoute::class, 'id', 'transport_type_id');
    }
    
}
