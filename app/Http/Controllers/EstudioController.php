<?php

namespace App\Http\Controllers;
use Validator;
use App\Entities\Grade;

use Illuminate\Http\Request;

class EstudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $estudios = Grade::all();
        $message = 'No hay estudios registradas';
        return view('grade.index')->with(['estudios' => $estudios, 'message' => $message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('grade.create')->with([]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $grade = new Grade();
        $grade->description = $request->input('description');
        $grade->save();
        $request->session()->flash('alert-success', 'Estudio creado correctamente');
        return redirect()->route('estudios.index')->withInput();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        return view('grade.edit')->with(['grade' => $grade]);
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
        $values = array('description');
        Grade::where('id',$id)->update($request->all($values));
        $request->session()->flash('alert-success', 'Estudio editado correctamente');
        return redirect()->route('estudios.index')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Grade::destroy($id);
        $request->session()->flash('alert-success', 'Estudio eliminado correctamente');
        return redirect()->route('estudios.index')->withInput();
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
        Grade::destroy($id);
        $request->session()->flash('alert-success', 'Estudio eliminada correctamente');
        return redirect()->route('estudios.index');
    }
}
