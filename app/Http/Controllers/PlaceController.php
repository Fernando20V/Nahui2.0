<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\PlaceCategory;
use App\Http\Requests\PlaceRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;

class PlaceController extends Controller
{
    /**
     * Mostrar la lista de Places con su categoría.
     */
    public function index(): View
    {
        // Traer places con la categoría para evitar N+1 queries
        $places = Place::with('placeCategory')->paginate(10);

        return view('places.index', compact('places'));
    }

    /**
     * Mostrar el formulario para crear un nuevo Place
     */
    public function create(): View
    {
        $categories = PlaceCategory::all();
        $place = new Place(); // necesario para form.blade
        return view('places.create', compact('categories', 'place'))
               ->with('action', route('places.store'));
    }

    /**
     * Guardar un nuevo Place
     */
    public function store(PlaceRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Manejo de status (radio buttons)
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

        // Asignar categoría
        $data['place_category_id'] = $request->categoria;

        Place::create($data);

        return Redirect::route('places.index')
            ->with('success', 'Lugar creado con éxito');
    }

    /**
     * Mostrar el formulario de edición
     */
    public function edit($id): View
    {
        $place = Place::findOrFail($id);
        $categories = PlaceCategory::all();

        return view('places.edit', compact('place', 'categories'))
               ->with('action', route('places.update', $place->id));
    }

    /**
     * Actualizar un Place
     */
    public function update(PlaceRequest $request, $id): RedirectResponse
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

        // Actualizar categoría
        $data['place_category_id'] = $request->categoria;

        $place->update($data);

        return Redirect::route('places.index')
            ->with('success', 'Lugar actualizado con éxito');
    }

    /**
     * Mostrar un Place específico
     */
    public function show($id): View
    {
        $place = Place::with(['placeCategory', 'address', 'organization'])->findOrFail($id);

        // Asegurar que imagenes siempre sea un array
        $imagenes = is_array($place->imagenes) ? $place->imagenes : [];

        return view('places.show', compact('place', 'imagenes'));
    }

/*catalogo de lugares*/

public function catalog()
{
    $places = \App\Models\Place::with('placeCategory')->get();

    // Agrupamos por categoría
    $grouped = $places->groupBy(fn($p) => strtolower($p->placeCategory->name ?? 'otros'));

    return view('places.catalog', compact('grouped'));
}


    /**
     * Eliminar un Place
     */
    public function destroy($id): RedirectResponse
    {
        $place = Place::findOrFail($id);
        $place->delete();

        return Redirect::route('places.index')
            ->with('deleted', 'Lugar eliminado con éxito');
    }
}
