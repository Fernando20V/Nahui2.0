<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Municipality
 *
 * @property $id
 * @property $department_id
 * @property $name
 * @property $created_at
 * @property $updated_at
 *
 * @property Department $department
 * @property Address[] $addresses
 * @property BusRoute[] $busRoutes
 * @property Stop[] $stops
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Municipality extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['department_id', 'name'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class, 'department_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany(\App\Models\Address::class, 'id', 'municipality_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function busRoutes()
    {
        return $this->hasMany(\App\Models\BusRoute::class, 'id', 'municipality_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stops()
    {
        return $this->hasMany(\App\Models\Stop::class, 'id', 'municipality_id');
    }
    
}
