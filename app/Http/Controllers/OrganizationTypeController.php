<?php

namespace App\Http\Controllers;

use App\Models\OrganizationType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\OrganizationTypeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class OrganizationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $organizationTypes = OrganizationType::paginate();

        return view('organization-type.index', compact('organizationTypes'))
            ->with('i', ($request->input('page', 1) - 1) * $organizationTypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $organizationType = new OrganizationType();

        return view('organization-type.create', compact('organizationType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganizationTypeRequest $request): RedirectResponse
    {
        OrganizationType::create($request->validated());

        return Redirect::route('organization-types.index')
            ->with('success', 'OrganizationType created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $organizationType = OrganizationType::find($id);

        return view('organization-type.show', compact('organizationType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $organizationType = OrganizationType::find($id);

        return view('organization-type.edit', compact('organizationType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrganizationTypeRequest $request, OrganizationType $organizationType): RedirectResponse
    {
        $organizationType->update($request->validated());

        return Redirect::route('organization-types.index')
            ->with('success', 'OrganizationType updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        OrganizationType::find($id)->delete();

        return Redirect::route('organization-types.index')
            ->with('success', 'OrganizationType deleted successfully');
    }
}
