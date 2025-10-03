<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Municipality;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\MunicipalityRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MunicipalityController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $municipalities= Municipality::with ('department')->paginate(10);
        return view ('municipalities.index',compact('municipalities'));
 }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $municipalities= new Municipality();
        $departments= Department::all();
        return view ('municipalities.create',compact('municipality','deapartments'));
 }


    /**
     * Store a newly created resource in storage.
     */
    public function store(MunicipalityRequest $request)
    {
        Municipality::create($request->validated());
        return redirect()->route('mumicipalities.index')->with('success','Municipio ha sido creado con éxito');
 }

    /**
     * Display the specified resource.
     */

    public function show(int $id)
    {
        $municipalities= Municipality::find($id);
        $department= Department::all();
        return view ('municipalities.show',compact('municipalities','departments'));
 }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $municipalities= Municipality::find($id);
        $departments= Department::all();
        return view ('municipalities.edit',compact('municipalities','departments'));

}

    /**
     * Update the specified resource in storage.
     */

    public function update(MunicipalityRequest $request, int $id)
    {
        $municipalities= Municipality::find($id);
        $municipalities->update($request->validated());
        return redirect()->route('municipalities.index')->with('updated','Municipio ha sido actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $municipalities= Municipality::find($id);
        $municipalities->delete();
        return redirect()->route('municipalities.index')->with('deleted','Municipio ha sido eliminado con éxito');
}

}
