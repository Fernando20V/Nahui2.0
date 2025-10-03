<?php

namespace App\Http\Controllers;

use App\Models\Stop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StopRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class StopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $stops = Stop::paginate();

        return view('stop.index', compact('stops'))
            ->with('i', ($request->input('page', 1) - 1) * $stops->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $stop = new Stop();

        return view('stop.create', compact('stop'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StopRequest $request): RedirectResponse
    {
        Stop::create($request->validated());

        return Redirect::route('stops.index')
            ->with('success', 'Stop created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $stop = Stop::find($id);

        return view('stop.show', compact('stop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $stop = Stop::find($id);

        return view('stop.edit', compact('stop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StopRequest $request, Stop $stop): RedirectResponse
    {
        $stop->update($request->validated());

        return Redirect::route('stops.index')
            ->with('success', 'Stop updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Stop::find($id)->delete();

        return Redirect::route('stops.index')
            ->with('success', 'Stop deleted successfully');
    }
}
