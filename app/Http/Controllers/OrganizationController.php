<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Requests;
use App\Http\Requests\OrganizationRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $organizations = Organization::latest()->paginate(10);
        return view('organizations.index',compact('organizations'));
}
    

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $organizations= new Organization();
        return view('organizations.create',compact('organizations'));
}

    /**
     * Store a newly created resource in storage.
     */

    public function store(OrganizationRequest $request)
    {
        Organization::create ($request->validated());
        return redirect()->route('organizations.index')->with('success','Organización ha sido creada con éxito');
    }
   

    /**
     * Display the specified resource.
     */

    public function show(int $id)
    {
        $organizations= Organization::find($id);
        return view('organizations.show',compact('organizations'));
}
    

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(int $id)
    {
        $organizations= Organization::find($id);
        return view ('Organizations.edit',compact('organizations'));
}


    /**
     * Update the specified resource in storage.
     */

    public function update(OrganizationRequest $request, int $id)
    {
        $organizations= Organization::find($id);
        $organizations->update($request->validated());
        return redirect()->route('organizations.index')->with('updated','Organización ha sido actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $organizations= Organization::find($id);
        $organizations->delete();
        return redirect()->route('organizations.index')->with('deleted','Organización ha sido eliminado con éxito');
    }
}

