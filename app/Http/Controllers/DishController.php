<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\DishRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $dishes = Dish::paginate();

        return view('dish.index', compact('dishes'))
            ->with('i', ($request->input('page', 1) - 1) * $dishes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $dish = new Dish();

        return view('dish.create', compact('dish'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DishRequest $request): RedirectResponse
    {
        Dish::create($request->validated());

        return Redirect::route('dishes.index')
            ->with('success', 'Dish created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $dish = Dish::find($id);

        return view('dish.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $dish = Dish::find($id);

        return view('dish.edit', compact('dish'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DishRequest $request, Dish $dish): RedirectResponse
    {
        $dish->update($request->validated());

        return Redirect::route('dishes.index')
            ->with('success', 'Dish updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Dish::find($id)->delete();

        return Redirect::route('dishes.index')
            ->with('success', 'Dish deleted successfully');
    }
}
