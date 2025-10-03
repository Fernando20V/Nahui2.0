<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AmenityRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $amenities = Amenity::paginate();

        return view('amenity.index', compact('amenities'))
            ->with('i', ($request->input('page', 1) - 1) * $amenities->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $amenity = new Amenity();

        return view('amenity.create', compact('amenity'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AmenityRequest $request): RedirectResponse
    {
        Amenity::create($request->validated());

        return Redirect::route('amenities.index')
            ->with('success', 'Amenity created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $amenity = Amenity::find($id);

        return view('amenity.show', compact('amenity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $amenity = Amenity::find($id);

        return view('amenity.edit', compact('amenity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AmenityRequest $request, Amenity $amenity): RedirectResponse
    {
        $amenity->update($request->validated());

        return Redirect::route('amenities.index')
            ->with('success', 'Amenity updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Amenity::find($id)->delete();

        return Redirect::route('amenities.index')
            ->with('success', 'Amenity deleted successfully');
    }
}
