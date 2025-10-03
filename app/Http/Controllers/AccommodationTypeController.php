<?php

namespace App\Http\Controllers;

use App\Models\AccommodationType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AccommodationTypeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AccommodationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $accommodationTypes = AccommodationType::paginate();

        return view('accommodation-type.index', compact('accommodationTypes'))
            ->with('i', ($request->input('page', 1) - 1) * $accommodationTypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $accommodationType = new AccommodationType();

        return view('accommodation-type.create', compact('accommodationType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccommodationTypeRequest $request): RedirectResponse
    {
        AccommodationType::create($request->validated());

        return Redirect::route('accommodation-types.index')
            ->with('success', 'AccommodationType created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $accommodationType = AccommodationType::find($id);

        return view('accommodation-type.show', compact('accommodationType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $accommodationType = AccommodationType::find($id);

        return view('accommodation-type.edit', compact('accommodationType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccommodationTypeRequest $request, AccommodationType $accommodationType): RedirectResponse
    {
        $accommodationType->update($request->validated());

        return Redirect::route('accommodation-types.index')
            ->with('success', 'AccommodationType updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        AccommodationType::find($id)->delete();

        return Redirect::route('accommodation-types.index')
            ->with('success', 'AccommodationType deleted successfully');
    }
}
