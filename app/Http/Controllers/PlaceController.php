<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\PlaceCategory;
use App\Models\Department;
use App\Models\Municipality;
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
        $places = Place::with('placeCategory')->paginate(10);
        return view('places.index', compact('places'));
    }

    /**
     * Mostrar el formulario para crear un nuevo Place
     */
    public function create(): View
    {
        $categories = PlaceCategory::all();
        $departments = Department::all(); // 🔹 Agregado
        $municipalities = collect(); // Vacío en create
        $place = new Place();

        return view('places.create', compact('categories', 'departments', 'municipalities', 'place'))
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

    // 🔹 Asignar departamento y municipio
    $data['department_id'] = $request->department_id;
    $data['municipality_id'] = $request->municipality_id;

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
        $departments = Department::all();
        $municipalities = $place->department_id 
            ? Municipality::where('department_id', $place->department_id)->get() 
            : collect();

        return view('places.edit', compact('place', 'categories', 'departments', 'municipalities'))
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

    $data['place_category_id'] = $request->categoria;

    // 🔹 Asignar departamento y municipio
    $data['department_id'] = $request->department_id;
    $data['municipality_id'] = $request->municipality_id;

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
        $imagenes = is_array($place->imagenes) ? $place->imagenes : [];

        return view('places.show', compact('place', 'imagenes'));
    }

    /**
     * Catalogo de lugares
     */
public function catalog()
{
    // Cargar todo con relaciones
    $places = Place::with(['placeCategory', 'department'])->get();

    //  Agrupar por categoría
    $byCategory = $places->groupBy(fn($p) => strtolower($p->placeCategory->name ?? 'otros'));

    //  Agrupar por departamento
    $byDepartment = $places->groupBy(fn($p) => strtolower($p->department->name ?? 'otros'));

    return view('places.catalog', [
        'byCategory' => $byCategory,
        'byDepartment' => $byDepartment,
    ]);
}

public function reservar(Place $place)
{
    // Cargamos relaciones necesarias
    $place->load(['resenas', 'placeCategory']); //

    // Obtenemos los datos
    $resenas = $place->resenas ?? [];
    $imagenes = $place->imagenes ?? []; // 
    $precio = $place->precio ?? 0;

    return view('places.reservar', compact('place', 'resenas', 'imagenes', 'precio'));
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
