<?php

namespace App\Http\Controllers;

use App\Models\Carrental;

use Illuminate\Http\Request;

class CarRentalController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carrentals= Carrental::with ('organization')->paginate(10);
        return view ('carrentals.index',compact('carrentals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carrentals= new Carrental();
        $organizations= Organization::all();
        return view ('carrentals.create',compact('carrentals','organizations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarrentalRequest $request)
    {
        Carrental::create($request->validated());
        return redirect()->route('carrentals.index')->with('success','Renta de vehiculos  creada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $carrentals= Carrental::find($id);
        $organizations= Organization::all();
        return view ('carrentals.show',compact('carrentals','organizations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $carrentals= Carrental::find($id);
        $organizations= Organization::all();
        return view ('carrentals.edit',compact('carrentals','organizations'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarrentalRequest $request, int $id)
    {
        $carrentals= Carrental::find($id);
        $carrentals->update($request->validated());
        return redirect()->route('carrentals.index')->with('updated','Renta de vehiculos ha sido actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $carrentals= carrental::find($id);
        $carrentals->delete();
        return redirect()->route('carrentals.index')->with('deleted','Renta de vehiculos ha sido eliminada con éxito');
    }
}

