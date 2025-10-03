<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    protected $casts = [
        'imagenes' => 'array',
        'hours' => 'array',
        'is_public' => 'boolean',
        'is_managed' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'place_category_id',
        'coordenadas',
        'description',
        'servicios',
        'habitaciones',
        'capacidad',
        'reglas',
        'promocion',
        'address_id',
        'is_public',
        'is_managed',
        'managing_org_id',
        'hours',
        'accessibility_notes',
        'entrance_fee',
        'currency',
        'imagenes'
    ];

    // Relaciones
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'managing_org_id', 'id');
    }

    public function placeCategory()
    {
        return $this->belongsTo(PlaceCategory::class, 'place_category_id', 'id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'place_id', 'id');
    }

    public function stops()
    {
        return $this->hasMany(Stop::class, 'place_id', 'id');
    }
}
