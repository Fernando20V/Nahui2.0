<?php

namespace App\Http\Controllers;

use App\Models\RestaurantCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\RestaurantCategoryRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RestaurantCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $restaurantCategories = RestaurantCategory::paginate();

        return view('restaurant-category.index', compact('restaurantCategories'))
            ->with('i', ($request->input('page', 1) - 1) * $restaurantCategories->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $restaurantCategory = new RestaurantCategory();

        return view('restaurant-category.create', compact('restaurantCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RestaurantCategoryRequest $request): RedirectResponse
    {
        RestaurantCategory::create($request->validated());

        return Redirect::route('restaurant-categories.index')
            ->with('success', 'RestaurantCategory created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $restaurantCategory = RestaurantCategory::find($id);

        return view('restaurant-category.show', compact('restaurantCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $restaurantCategory = RestaurantCategory::find($id);

        return view('restaurant-category.edit', compact('restaurantCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RestaurantCategoryRequest $request, RestaurantCategory $restaurantCategory): RedirectResponse
    {
        $restaurantCategory->update($request->validated());

        return Redirect::route('restaurant-categories.index')
            ->with('success', 'RestaurantCategory updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        RestaurantCategory::find($id)->delete();

        return Redirect::route('restaurant-categories.index')
            ->with('success', 'RestaurantCategory deleted successfully');
    }
}
