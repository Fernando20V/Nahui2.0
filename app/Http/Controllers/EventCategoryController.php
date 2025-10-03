<?php

namespace App\Http\Controllers;

use App\Models\EventCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EventCategoryRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class EventCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $eventCategories = EventCategory::paginate();

        return view('event-category.index', compact('eventCategories'))
            ->with('i', ($request->input('page', 1) - 1) * $eventCategories->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $eventCategory = new EventCategory();

        return view('event-category.create', compact('eventCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventCategoryRequest $request): RedirectResponse
    {
        EventCategory::create($request->validated());

        return Redirect::route('event-categories.index')
            ->with('success', 'EventCategory created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $eventCategory = EventCategory::find($id);

        return view('event-category.show', compact('eventCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $eventCategory = EventCategory::find($id);

        return view('event-category.edit', compact('eventCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventCategoryRequest $request, EventCategory $eventCategory): RedirectResponse
    {
        $eventCategory->update($request->validated());

        return Redirect::route('event-categories.index')
            ->with('success', 'EventCategory updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        EventCategory::find($id)->delete();

        return Redirect::route('event-categories.index')
            ->with('success', 'EventCategory deleted successfully');
    }
}
