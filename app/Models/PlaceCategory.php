<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlaceCategory
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property Place[] $places
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PlaceCategory extends Model
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
    public function places()
    {
        return $this->hasMany(\App\Models\Place::class, 'id', 'place_category_id');
    }
    
}
