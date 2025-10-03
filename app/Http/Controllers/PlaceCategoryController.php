<?php

namespace App\Http\Controllers;

use App\Models\PlaceCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PlaceCategoryRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PlaceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $placeCategories = PlaceCategory::paginate();

        return view('place-category.index', compact('placeCategories'))
            ->with('i', ($request->input('page', 1) - 1) * $placeCategories->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $placeCategory = new PlaceCategory();

        return view('place-category.create', compact('placeCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlaceCategoryRequest $request): RedirectResponse
    {
        PlaceCategory::create($request->validated());

        return Redirect::route('place-categories.index')
            ->with('success', 'PlaceCategory created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $placeCategory = PlaceCategory::find($id);

        return view('place-category.show', compact('placeCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $placeCategory = PlaceCategory::find($id);

        return view('place-category.edit', compact('placeCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlaceCategoryRequest $request, PlaceCategory $placeCategory): RedirectResponse
    {
        $placeCategory->update($request->validated());

        return Redirect::route('place-categories.index')
            ->with('success', 'PlaceCategory updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        PlaceCategory::find($id)->delete();

        return Redirect::route('place-categories.index')
            ->with('success', 'PlaceCategory deleted successfully');
    }
}
