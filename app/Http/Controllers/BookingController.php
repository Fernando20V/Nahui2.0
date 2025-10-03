<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $bookings = Booking::paginate();

        return view('booking.index', compact('bookings'))
            ->with('i', ($request->input('page', 1) - 1) * $bookings->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $booking = new Booking();

        return view('booking.create', compact('booking'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingRequest $request): RedirectResponse
    {
        Booking::create($request->validated());

        return Redirect::route('bookings.index')
            ->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $booking = Booking::find($id);

        return view('booking.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $booking = Booking::find($id);

        return view('booking.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookingRequest $request, Booking $booking): RedirectResponse
    {
        $booking->update($request->validated());

        return Redirect::route('bookings.index')
            ->with('success', 'Booking updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Booking::find($id)->delete();

        return Redirect::route('bookings.index')
            ->with('success', 'Booking deleted successfully');
    }
}
