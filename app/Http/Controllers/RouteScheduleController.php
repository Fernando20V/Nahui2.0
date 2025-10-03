<?php

namespace App\Http\Controllers;

use App\Models\RouteSchedule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\RouteScheduleRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RouteScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $routeSchedules = RouteSchedule::paginate();

        return view('route-schedule.index', compact('routeSchedules'))
            ->with('i', ($request->input('page', 1) - 1) * $routeSchedules->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $routeSchedule = new RouteSchedule();

        return view('route-schedule.create', compact('routeSchedule'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RouteScheduleRequest $request): RedirectResponse
    {
        RouteSchedule::create($request->validated());

        return Redirect::route('route-schedules.index')
            ->with('success', 'RouteSchedule created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $routeSchedule = RouteSchedule::find($id);

        return view('route-schedule.show', compact('routeSchedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $routeSchedule = RouteSchedule::find($id);

        return view('route-schedule.edit', compact('routeSchedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RouteScheduleRequest $request, RouteSchedule $routeSchedule): RedirectResponse
    {
        $routeSchedule->update($request->validated());

        return Redirect::route('route-schedules.index')
            ->with('success', 'RouteSchedule updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        RouteSchedule::find($id)->delete();

        return Redirect::route('route-schedules.index')
            ->with('success', 'RouteSchedule deleted successfully');
    }
}
