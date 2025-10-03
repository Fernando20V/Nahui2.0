<?php

namespace App\Http\Controllers;

use App\Models\AmenityCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AmenityCategoryRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AmenityCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $amenityCategories = AmenityCategory::paginate();

        return view('amenity-category.index', compact('amenityCategories'))
            ->with('i', ($request->input('page', 1) - 1) * $amenityCategories->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $amenityCategory = new AmenityCategory();

        return view('amenity-category.create', compact('amenityCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AmenityCategoryRequest $request): RedirectResponse
    {
        AmenityCategory::create($request->validated());

        return Redirect::route('amenity-categories.index')
            ->with('success', 'AmenityCategory created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $amenityCategory = AmenityCategory::find($id);

        return view('amenity-category.show', compact('amenityCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $amenityCategory = AmenityCategory::find($id);

        return view('amenity-category.edit', compact('amenityCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AmenityCategoryRequest $request, AmenityCategory $amenityCategory): RedirectResponse
    {
        $amenityCategory->update($request->validated());

        return Redirect::route('amenity-categories.index')
            ->with('success', 'AmenityCategory updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        AmenityCategory::find($id)->delete();

        return Redirect::route('amenity-categories.index')
            ->with('success', 'AmenityCategory deleted successfully');
    }
}
