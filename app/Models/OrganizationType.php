<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrganizationType
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property Organization[] $organizations
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class OrganizationType extends Model
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
    public function organizations()
    {
        return $this->hasMany(\App\Models\Organization::class, 'id', 'organization_type_id');
    }
    
}
