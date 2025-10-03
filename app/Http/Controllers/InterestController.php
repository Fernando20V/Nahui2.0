<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Interest;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\InterestRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class InterestController extends Controller

{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $interests = Interest::latest()->paginate(10);
        return view('interests.index',compact('interests'));
}

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $interests= new Interest();
        return view('interests.create',compact('interests'));
}


    /**
     * Store a newly created resource in storage.
     */


    public function store(InterestRequest $request)
    {
        Interest::create ($request->validated());
        return redirect()->route('interests.index')->with('success','Interes creado con éxito');
}
    


    /**
     * Display the specified resource.
     */

    public function show(int $id)
    {
        $interests= Interest::find($id);
        return view('interests.show',compact('interests'));
}



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $interests= Interest::find($id);
        return view ('interests.edit',compact('interests'));
}
    /**
     * Update the specified resource in storage.
     */
    public function update(InterestRequest $request, int $id)
    {
        $interests= Interest::find($id);
        $interests->update($request->validated());
        return redirect()->route('interests.index')->with('updated','Interes actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $interests= Interest::find($id);
        $interests->delete();
        return redirect()->route('interests.index')->with('deleted','Interes eliminado con éxito');
}
   
}
