<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AccommodationType
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property Accommodation[] $accommodations
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AccommodationType extends Model
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
    public function accommodations()
    {
        return $this->hasMany(\App\Models\Accommodation::class, 'id', 'accommodation_type_id');
    }
    
}
