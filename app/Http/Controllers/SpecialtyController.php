<?php

namespace App\Http\Controllers;
use Validator;
use App\Entities\Specialty;
use App\Entities\Grade;

use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $specialties = Specialty::all();
        $message = 'No hay especialidades registradas';
        return view('specialty.index')->with(['specialties' => $specialties, 'message' => $message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::all();
        return view('specialty.create')->with(['grades'=>$grades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $specialty = new Specialty();
        $specialty->description = $request->input('description');
        $specialty->grade_id = $request->input('grade_id');
        $specialty->save();
        $request->session()->flash('alert-success', 'Especialidad creado correctamente');
        return redirect()->route('especialidades.index')->withInput();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $specialty = Specialty::findOrFail($id);
        $grades = Grade::all();
        return view('specialty.edit')->with(['specialty' => $specialty,'grades'=>$grades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $values = array('description','grade_id');
        Specialty::where('id',$id)->update($request->all($values));
        $request->session()->flash('alert-success', 'Especialidades editado correctamente');
        return redirect()->route('especialidades.index')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Specialty::destroy($id);
        $request->session()->flash('alert-success', 'Especialidades eliminado correctamente');
        return redirect()->route('especialidades.index')->withInput();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract  $puesto)
    {}
    public function remove(Request $request, $id)
    {
        Specialty::destroy($id);
        $request->session()->flash('alert-success', 'Especialidad eliminada correctamente');
        return redirect()->route('especialidades.index');
    }
}
