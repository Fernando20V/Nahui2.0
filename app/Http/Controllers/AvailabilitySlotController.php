<?php

namespace App\Http\Controllers;

use App\Models\AvailabilitySlot;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AvailabilitySlotRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AvailabilitySlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $availabilitySlots = AvailabilitySlot::paginate();

        return view('availability-slot.index', compact('availabilitySlots'))
            ->with('i', ($request->input('page', 1) - 1) * $availabilitySlots->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $availabilitySlot = new AvailabilitySlot();

        return view('availability-slot.create', compact('availabilitySlot'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AvailabilitySlotRequest $request): RedirectResponse
    {
        AvailabilitySlot::create($request->validated());

        return Redirect::route('availability-slots.index')
            ->with('success', 'AvailabilitySlot created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $availabilitySlot = AvailabilitySlot::find($id);

        return view('availability-slot.show', compact('availabilitySlot'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $availabilitySlot = AvailabilitySlot::find($id);

        return view('availability-slot.edit', compact('availabilitySlot'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AvailabilitySlotRequest $request, AvailabilitySlot $availabilitySlot): RedirectResponse
    {
        $availabilitySlot->update($request->validated());

        return Redirect::route('availability-slots.index')
            ->with('success', 'AvailabilitySlot updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        AvailabilitySlot::find($id)->delete();

        return Redirect::route('availability-slots.index')
            ->with('success', 'AvailabilitySlot deleted successfully');
    }
}
