<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EventCategory
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property Event[] $events
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class EventCategory extends Model
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
    public function events()
    {
        return $this->hasMany(\App\Models\Event::class, 'id', 'event_category_id');
    }
    
}
