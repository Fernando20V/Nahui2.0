<?php

namespace App\Http\Controllers;

use App\Models\BookingDay;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\BookingDayRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class BookingDayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $bookingDays = BookingDay::paginate();

        return view('booking-day.index', compact('bookingDays'))
            ->with('i', ($request->input('page', 1) - 1) * $bookingDays->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $bookingDay = new BookingDay();

        return view('booking-day.create', compact('bookingDay'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingDayRequest $request): RedirectResponse
    {
        BookingDay::create($request->validated());

        return Redirect::route('booking-days.index')
            ->with('success', 'BookingDay created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $bookingDay = BookingDay::find($id);

        return view('booking-day.show', compact('bookingDay'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $bookingDay = BookingDay::find($id);

        return view('booking-day.edit', compact('bookingDay'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookingDayRequest $request, BookingDay $bookingDay): RedirectResponse
    {
        $bookingDay->update($request->validated());

        return Redirect::route('booking-days.index')
            ->with('success', 'BookingDay updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        BookingDay::find($id)->delete();

        return Redirect::route('booking-days.index')
            ->with('success', 'BookingDay deleted successfully');
    }
}
