<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Requests;
use App\Http\Requests\AddressRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $addresses = Address::latest()->paginate(10);
        return view('addresses.index',compact('addresses'));
}
   
    

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $addresses= new Address();
        return view('addresses.create',compact('addresses'));

    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(AddressRequest $request)
    {
        Address::create ($request->validated());
        return redirect()->route('addresses.index')->with('success','Dirección ha sido creado con éxito');

}



    /**
     * Display the specified resource.
     */

    public function show(int $id)
    {
        $addresses= Address::find($id);
        return view('addresses.show',compact('addresses'));
}


    /**
     * Show the form for editing the specified resource.
     */

    public function edit(int $id)
    {
        $addresses= Address::find($id);
        return view ('addresses.edit',compact('addresses'));
}

    

    /**
     * Update the specified resource in storage.
     */

    public function update(AddressRequest $request, int $id)
    {
        $addresses= Address::find($id);
        $addresses->update($request->validated());
        return redirect()->route('addresses.index')->with('success','Dirección ha sido actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $addresses= Address::find($id);
        $addresses->delete();
        return redirect()->route('addresses.index')->with('success','Dirección ha sido eliminado con éxito');
    }


     

}
