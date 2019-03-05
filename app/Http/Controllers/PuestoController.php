<?php

namespace App\Http\Controllers;
use Validator;
use App\Entities\Puesto;

use Illuminate\Http\Request;

class PuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $puestos = Puesto::all();
        $message = "No hay puestos registradas";
        return view('puesto.index')->with(['puestos' => $puestos, 'message' => $message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('puesto.create')->with([]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $puesto = new Puesto();
        $puesto->nombre = $request->input('name');
        $puesto->nome = $request->input('name_gl');
        $puesto->save();
        $request->session()->flash('alert-success', 'Puesto creado correctamente');
        return redirect()->route('puestos.index')->withInput();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $puesto = Puesto::findOrFail($id);
        return view('puesto.edit')->with(['puesto' => $puesto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $values = array('name','name_gl');
        Puesto::where('id',$id)->update($request->all($values));
        $request->session()->flash('alert-success', 'Puesto editado correctamente');
        return redirect()->route('puestos.index')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Puesto::destroy($id);
        $request->session()->flash('alert-success', 'Puesto eliminado correctamente');
        return redirect()->route('puestos.index')->withInput();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function show(Puesto  $puesto)
    {}
}
