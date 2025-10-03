<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Http\Requests\PlaceRequest;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::paginate(10);
        return view('places.index', compact('places'));
    }

    public function create()
    {
        return view('places.create');
    }

public function store(PlaceRequest $request)
{
    $data = $request->validated();

    // Radios en lugar de checkboxes
    $data['is_public'] = $request->status === 'public';
    $data['is_managed'] = $request->status === 'managed';

    // Manejo de imágenes
    if ($request->hasFile('imagenes')) {
        $imagenes = [];
        foreach ($request->file('imagenes') as $file) {
            $path = $file->store('places', 'public');
            $imagenes[] = $path;
        }
        $data['imagenes'] = $imagenes;
    }

    Place::create($data);

    return redirect()->route('places.index')->with('success', 'Lugar creado con éxito');
}

    public function edit($id)
    {
        $place = Place::findOrFail($id);
        return view('places.edit', compact('place'));
    }


public function update(PlaceRequest $request, $id)
{
    $place = Place::findOrFail($id);
    $data = $request->validated();

    $data['is_public'] = $request->status === 'public';
    $data['is_managed'] = $request->status === 'managed';

    if ($request->hasFile('imagenes')) {
        $imagenes = [];
        foreach ($request->file('imagenes') as $file) {
            $path = $file->store('places', 'public');
            $imagenes[] = $path;
        }
        $data['imagenes'] = $imagenes;
    }

    $place->update($data);

    return redirect()->route('places.index')->with('success', 'Lugar actualizado con éxito');
}

public function show($id)
{
    $place = Place::with(['placeCategory', 'address', 'organization'])->findOrFail($id);

    // Asegurar que el campo imagenes siempre sea un array
    $imagenes = is_array($place->imagenes) ? $place->imagenes : [];

    return view('places.show', compact('place', 'imagenes'));
}

    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $place->delete();

        return redirect()->route('places.index')->with('deleted', 'Lugar eliminado con éxito');
    }
}
