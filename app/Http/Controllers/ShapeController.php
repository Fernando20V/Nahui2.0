<?php

namespace App\Http\Controllers;

use App\Models\Shape;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ShapeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ShapeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $shapes = Shape::paginate();

        return view('shape.index', compact('shapes'))
            ->with('i', ($request->input('page', 1) - 1) * $shapes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $shape = new Shape();

        return view('shape.create', compact('shape'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShapeRequest $request): RedirectResponse
    {
        Shape::create($request->validated());

        return Redirect::route('shapes.index')
            ->with('success', 'Shape created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $shape = Shape::find($id);

        return view('shape.show', compact('shape'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $shape = Shape::find($id);

        return view('shape.edit', compact('shape'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShapeRequest $request, Shape $shape): RedirectResponse
    {
        $shape->update($request->validated());

        return Redirect::route('shapes.index')
            ->with('success', 'Shape updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Shape::find($id)->delete();

        return Redirect::route('shapes.index')
            ->with('success', 'Shape deleted successfully');
    }
}
