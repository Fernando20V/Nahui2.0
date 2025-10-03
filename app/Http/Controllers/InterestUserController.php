<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\InterestUser;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\InterestUserRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class InterestUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $interestusers = InterestUser::latest()->paginate(10);
        return view('interestusers.index',compact('interestusers'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $interestusers= new InterestUser();
        return view('interestusers.create',compact('interestusers'));
}
   
    /**
     * Store a newly created resource in storage.
     */
    public function store(InterestUserRequest $request)
    {
        InterestUser::create ($request->validated());
        return redirect()->route('interestusers.index')->with('success','Interes de usuario creado con éxito');
}

    /**
     * Display the specified resource.
     */

    public function show(int $id)
    {
        $interestusers= InterestUser::find($id);
        return view('interestusers.show',compact('interestusers'));
}
 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $interestusers= InterestUser::find($id);
        return view ('interestusers.edit',compact('interestusers'));
}

    /**
     * Update the specified resource in storage.
     */

    public function update(InterestUserRequest $request, int $id)
    {
        $interestusers= InterestUser::find($id);
        $interestusers->update($request->validated());
        return redirect()->route('interestusers.index')->with('success','Interes de usuario actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $interestusers= InterestUser::find($id);
        $interestusers->delete();
        return redirect()->route('interestusers.index')->with('success','Interes de usuario eliminado con éxito');
}

}
