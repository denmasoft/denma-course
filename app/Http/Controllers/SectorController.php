<?php

namespace App\Http\Controllers;
use Validator;
use App\Entities\Sector;

use Illuminate\Http\Request;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sectores = Sector::all();
        $message = "No hay sectores registradas";
        return view('sector.index')->with(['sectores' => $sectores, 'message' => $message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sector.create')->with([]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sector = new Sector();
        $sector->nombre = $request->input('name');
        $sector->nome = $request->input('name_gl');
        $sector->save();
        $request->session()->flash('alert-success', 'Sector creado correctamente');
        return redirect()->route('sectores.index')->withInput();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sector = Sector::findOrFail($id);
        return view('sector.edit')->with(['sector' => $sector]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $values = array('name','name_gl');
        Sector::where('id',$id)->update($request->all($values));
        $request->session()->flash('alert-success', 'Sector editado correctamente');
        return redirect()->route('sectores.index')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Sector::destroy($id);
        $request->session()->flash('alert-success', 'Sector eliminado correctamente');
        return redirect()->route('sectores.index')->withInput();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show(Sector  $sector)
    {}
}
