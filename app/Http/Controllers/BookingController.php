<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Mostrar la página de reservar para un place específico
     */
    public function reservar(Place $place)
    {
        $imagenes = $place->imagenes ?? [];
        $resenas = $place->resenas ?? [];
        $precio = $place->accommodation->base_price ?? 0;

        return view('places.reservar', compact('place', 'imagenes', 'resenas', 'precio'));
    }

    /**
     * Guardar la reserva
     */
public function store(Request $request, Place $place)
{
    // Validación
    $request->validate([
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after:start_date',
        'guests' => 'required|integer|min:1',
    ]);

    $startDate = Carbon::parse($request->start_date);
    $endDate = Carbon::parse($request->end_date);
    $nights = $startDate->diffInDays($endDate);
    $totalPrice = ($place->entrance_fee ?? 0) * $nights;
    $currency = $place->currency ?? 'USD';

Booking::create([
    'user_id' => Auth::id(),
    // 'place_id' => $place->id,   
    'accommodation_id' => $place->accommodation->id, // 
    'start_date' => $startDate->format('Y-m-d'),
    'end_date' => $endDate->format('Y-m-d'),
    'guests' => $request->guests,
    'total_price' => $totalPrice,
    'currency' => $currency,
    'status' => 'pending',
]);

    return redirect()->route('places.reservar', $place->id)
                     ->with('success', '¡Reserva realizada correctamente!');
}

}