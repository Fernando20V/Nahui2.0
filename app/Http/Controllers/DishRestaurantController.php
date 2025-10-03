<?php

namespace App\Http\Controllers;

use App\Models\DishRestaurant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\DishRestaurantRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DishRestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $dishRestaurants = DishRestaurant::paginate();

        return view('dish-restaurant.index', compact('dishRestaurants'))
            ->with('i', ($request->input('page', 1) - 1) * $dishRestaurants->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $dishRestaurant = new DishRestaurant();

        return view('dish-restaurant.create', compact('dishRestaurant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DishRestaurantRequest $request): RedirectResponse
    {
        DishRestaurant::create($request->validated());

        return Redirect::route('dish-restaurants.index')
            ->with('success', 'DishRestaurant created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $dishRestaurant = DishRestaurant::find($id);

        return view('dish-restaurant.show', compact('dishRestaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $dishRestaurant = DishRestaurant::find($id);

        return view('dish-restaurant.edit', compact('dishRestaurant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DishRestaurantRequest $request, DishRestaurant $dishRestaurant): RedirectResponse
    {
        $dishRestaurant->update($request->validated());

        return Redirect::route('dish-restaurants.index')
            ->with('success', 'DishRestaurant updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        DishRestaurant::find($id)->delete();

        return Redirect::route('dish-restaurants.index')
            ->with('success', 'DishRestaurant deleted successfully');
    }
}
