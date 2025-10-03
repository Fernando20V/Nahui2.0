<?php

namespace App\Http\Controllers;

use App\Models\AccommodationAmenity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AccommodationAmenityRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AccommodationAmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $accommodationAmenities = AccommodationAmenity::paginate();

        return view('accommodation-amenity.index', compact('accommodationAmenities'))
            ->with('i', ($request->input('page', 1) - 1) * $accommodationAmenities->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $accommodationAmenity = new AccommodationAmenity();

        return view('accommodation-amenity.create', compact('accommodationAmenity'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccommodationAmenityRequest $request): RedirectResponse
    {
        AccommodationAmenity::create($request->validated());

        return Redirect::route('accommodation-amenities.index')
            ->with('success', 'AccommodationAmenity created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $accommodationAmenity = AccommodationAmenity::find($id);

        return view('accommodation-amenity.show', compact('accommodationAmenity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $accommodationAmenity = AccommodationAmenity::find($id);

        return view('accommodation-amenity.edit', compact('accommodationAmenity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccommodationAmenityRequest $request, AccommodationAmenity $accommodationAmenity): RedirectResponse
    {
        $accommodationAmenity->update($request->validated());

        return Redirect::route('accommodation-amenities.index')
            ->with('success', 'AccommodationAmenity updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        AccommodationAmenity::find($id)->delete();

        return Redirect::route('accommodation-amenities.index')
            ->with('success', 'AccommodationAmenity deleted successfully');
    }
}
