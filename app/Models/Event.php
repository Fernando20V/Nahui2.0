<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Event
 *
 * @property $id
 * @property $title
 * @property $event_category_id
 * @property $author
 * @property $description
 * @property $start_at
 * @property $end_at
 * @property $recurrence
 * @property $address_id
 * @property $place_id
 * @property $cost
 * @property $currency
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Address $address
 * @property EventCategory $eventCategory
 * @property Place $place
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Event extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['title', 'event_category_id', 'author', 'description', 'start_at', 'end_at', 'recurrence', 'address_id', 'place_id', 'cost', 'currency'];


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
    public function eventCategory()
    {
        return $this->belongsTo(\App\Models\EventCategory::class, 'event_category_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place()
    {
        return $this->belongsTo(\App\Models\Place::class, 'place_id', 'id');
    }
    
}
