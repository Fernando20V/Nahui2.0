<?php

namespace App\Http\Controllers;

use App\Models\BusRoute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\BusRouteRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class BusRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $busRoutes = BusRoute::paginate();

        return view('bus-route.index', compact('busRoutes'))
            ->with('i', ($request->input('page', 1) - 1) * $busRoutes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $busRoute = new BusRoute();

        return view('bus-route.create', compact('busRoute'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BusRouteRequest $request): RedirectResponse
    {
        BusRoute::create($request->validated());

        return Redirect::route('bus-routes.index')
            ->with('success', 'BusRoute created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $busRoute = BusRoute::find($id);

        return view('bus-route.show', compact('busRoute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $busRoute = BusRoute::find($id);

        return view('bus-route.edit', compact('busRoute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BusRouteRequest $request, BusRoute $busRoute): RedirectResponse
    {
        $busRoute->update($request->validated());

        return Redirect::route('bus-routes.index')
            ->with('success', 'BusRoute updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        BusRoute::find($id)->delete();

        return Redirect::route('bus-routes.index')
            ->with('success', 'BusRoute deleted successfully');
    }
}
