<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AvailabilitySlot
 *
 * @property $id
 * @property $accommodation_id
 * @property $start_date
 * @property $end_date
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Accommodation $accommodation
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AvailabilitySlot extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['accommodation_id', 'start_date', 'end_date', 'status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accommodation()
    {
        return $this->belongsTo(\App\Models\Accommodation::class, 'accommodation_id', 'id');
    }
    
}
