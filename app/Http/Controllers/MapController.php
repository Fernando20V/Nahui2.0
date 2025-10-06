<?php

namespace App\Http\Controllers;

use App\Models\Place;

class MapController extends Controller
{
    public function index()
    {
        // Traer todos los lugares con dirección y categoría
        $places = Place::with(['address', 'placeCategory'])->get();

        // Retornar la vista y pasarle los lugares
        return view('places.mapa', compact('places'));
    }

    public function mapa()
    {
        // Traer solo los campos necesarios y la categoría
        $places = Place::with('placeCategory')->get(['id', 'name', 'latitude', 'longitude', 'place_category_id']);
        return view('mapa', compact('places'));
    }
}
