<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Organization
 *
 * @property $id
 * @property $name
 * @property $organization_type_id
 * @property $contact_email
 * @property $contact_phone
 * @property $website
 * @property $address_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Address $address
 * @property OrganizationType $organizationType
 * @property Accommodation[] $accommodations
 * @property BusRoute[] $busRoutes
 * @property OrganizationRoute[] $organizationRoutes
 * @property Place[] $places
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Organization extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'organization_type_id', 'contact_email', 'contact_phone', 'website', 'address_id'];


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
    public function organizationType()
    {
        return $this->belongsTo(\App\Models\OrganizationType::class, 'organization_type_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accommodations()
    {
        return $this->hasMany(\App\Models\Accommodation::class, 'id', 'organization_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function busRoutes()
    {
        return $this->hasMany(\App\Models\BusRoute::class, 'id', 'organization_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organizationRoutes()
    {
        return $this->hasMany(\App\Models\OrganizationRoute::class, 'id', 'organization_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function places()
    {
        return $this->hasMany(\App\Models\Place::class, 'id', 'managing_org_id');
    }
    
}
