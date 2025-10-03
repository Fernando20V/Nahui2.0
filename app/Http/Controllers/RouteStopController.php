<?php

namespace App\Http\Controllers;

use App\Models\RouteStop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\RouteStopRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RouteStopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $routeStops = RouteStop::paginate();

        return view('route-stop.index', compact('routeStops'))
            ->with('i', ($request->input('page', 1) - 1) * $routeStops->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $routeStop = new RouteStop();

        return view('route-stop.create', compact('routeStop'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RouteStopRequest $request): RedirectResponse
    {
        RouteStop::create($request->validated());

        return Redirect::route('route-stops.index')
            ->with('success', 'RouteStop created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $routeStop = RouteStop::find($id);

        return view('route-stop.show', compact('routeStop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $routeStop = RouteStop::find($id);

        return view('route-stop.edit', compact('routeStop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RouteStopRequest $request, RouteStop $routeStop): RedirectResponse
    {
        $routeStop->update($request->validated());

        return Redirect::route('route-stops.index')
            ->with('success', 'RouteStop updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        RouteStop::find($id)->delete();

        return Redirect::route('route-stops.index')
            ->with('success', 'RouteStop deleted successfully');
    }
}
