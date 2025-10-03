<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\RestaurantRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $restaurants = Restaurant::paginate();

        return view('restaurant.index', compact('restaurants'))
            ->with('i', ($request->input('page', 1) - 1) * $restaurants->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $restaurant = new Restaurant();

        return view('restaurant.create', compact('restaurant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RestaurantRequest $request): RedirectResponse
    {
        Restaurant::create($request->validated());

        return Redirect::route('restaurants.index')
            ->with('success', 'Restaurant created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $restaurant = Restaurant::find($id);

        return view('restaurant.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $restaurant = Restaurant::find($id);

        return view('restaurant.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RestaurantRequest $request, Restaurant $restaurant): RedirectResponse
    {
        $restaurant->update($request->validated());

        return Redirect::route('restaurants.index')
            ->with('success', 'Restaurant updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Restaurant::find($id)->delete();

        return Redirect::route('restaurants.index')
            ->with('success', 'Restaurant deleted successfully');
    }
}
