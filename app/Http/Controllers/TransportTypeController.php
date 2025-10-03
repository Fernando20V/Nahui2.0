<?php

namespace App\Http\Controllers;

use App\Models\TransportType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TransportTypeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TransportTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $transportTypes = TransportType::paginate();

        return view('transport-type.index', compact('transportTypes'))
            ->with('i', ($request->input('page', 1) - 1) * $transportTypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $transportType = new TransportType();

        return view('transport-type.create', compact('transportType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransportTypeRequest $request): RedirectResponse
    {
        TransportType::create($request->validated());

        return Redirect::route('transport-types.index')
            ->with('success', 'TransportType created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $transportType = TransportType::find($id);

        return view('transport-type.show', compact('transportType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $transportType = TransportType::find($id);

        return view('transport-type.edit', compact('transportType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransportTypeRequest $request, TransportType $transportType): RedirectResponse
    {
        $transportType->update($request->validated());

        return Redirect::route('transport-types.index')
            ->with('success', 'TransportType updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        TransportType::find($id)->delete();

        return Redirect::route('transport-types.index')
            ->with('success', 'TransportType deleted successfully');
    }
}
