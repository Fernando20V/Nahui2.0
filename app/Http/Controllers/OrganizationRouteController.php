<?php

namespace App\Http\Controllers;

use App\Models\OrganizationRoute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\OrganizationRouteRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class OrganizationRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $organizationRoutes = OrganizationRoute::paginate();

        return view('organization-route.index', compact('organizationRoutes'))
            ->with('i', ($request->input('page', 1) - 1) * $organizationRoutes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $organizationRoute = new OrganizationRoute();

        return view('organization-route.create', compact('organizationRoute'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganizationRouteRequest $request): RedirectResponse
    {
        OrganizationRoute::create($request->validated());

        return Redirect::route('organization-routes.index')
            ->with('success', 'OrganizationRoute created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $organizationRoute = OrganizationRoute::find($id);

        return view('organization-route.show', compact('organizationRoute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $organizationRoute = OrganizationRoute::find($id);

        return view('organization-route.edit', compact('organizationRoute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrganizationRouteRequest $request, OrganizationRoute $organizationRoute): RedirectResponse
    {
        $organizationRoute->update($request->validated());

        return Redirect::route('organization-routes.index')
            ->with('success', 'OrganizationRoute updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        OrganizationRoute::find($id)->delete();

        return Redirect::route('organization-routes.index')
            ->with('success', 'OrganizationRoute deleted successfully');
    }
}
