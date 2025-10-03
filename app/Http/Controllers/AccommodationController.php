<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Accommodation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Requests;
use App\Http\Requests\AccommodationRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;



class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    
    public function index()
    {
        $accommodations= Accommodation::with ('organization','address')->paginate(10);
        return view ('accommodations.index',compact('accommodations'));
    
    }

    
    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $accommodations= new Accommodation();
        $organizations= Organization::all();
        $addresses= Address::all();
        return view ('accommodations.create',compact('accommodations','organizations','addresses'));
    }
  
    /**
     * Store a newly created resource in storage.
     */

    public function store(AccommodationRequest $request)
    {
        Accommodation::create($request->validated());
        return redirect()->route('accommodations.index')->with('success','Alojamientos ha sido creado con éxito');
}
   
    /**
     * Display the specified resource.
     */

    public function show(int $id)
    {
        $accommodations= Accommodation::find($id);
        $organizations= Organization::all();
        $addresses= Address::all();
        return view ('accommodations.show',compact('accommodations','organizations','addresses'));
        }
   

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(int $id)
    {
        $accommodations= Accommodation::find($id);
        $organizations= Organization::all();
        $addresses= Address::all();
        return view ('accommodations.edit',compact('accommodations','organizations','addresses'));
}
    

    /**
     * Update the specified resource in storage.
     */

    public function update(AccommodationRequest $request, int $id)
    {
        $accommodations= Accommodation::find($id);
        $accommodations->update($request->validated());
        return redirect()->route('accommodations.index')->with('updated','Alojamientos ha sido actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $accommodations= Accommodation::find($id);
        $accommodations->delete();
        return redirect()->route('accommodations.index')->with('deleted','Alojamientos ha sido eliminado con éxito');
}
   

}
