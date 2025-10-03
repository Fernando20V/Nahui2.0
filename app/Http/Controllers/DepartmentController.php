<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $departments = Department::latest()->paginate(10);
        return view('departments.index',compact('departments'));
}
    

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $departments= new Department();
        return view('departments.create',compact('departments'));
}
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        Department::create ($request->validated());
        return redirect()->route('departments.index')->with('success','Departamento ha sido creado con éxito');
}


    /**
     * Display the specified resource.
     */

    public function show(int $id)
    {
        $departments= Department::find($id);
        return view('departments.show',compact('departments'));
}

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(int $id)
    {
        $departments= Department::find($id);
        return view ('departments.edit',compact('departments'));
}


    /**
     * Update the specified resource in storage.
     */


    public function update(DepartmentRequest $request, int $id)
    {
        $departments= Department::find($id);
        $departments->update($request->validated());
        return redirect()->route('departments.index')->with('success','Departamento ha sido actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $departments= Department::find($id);
        $departments->delete();
        return redirect()->route('departments.index')->with('success','Departamento ha sido eliminado con éxito');

        Department::find($id)->delete();

        return Redirect::route('departments.index')
            ->with('success', 'Department deleted successfully');
    }
}
