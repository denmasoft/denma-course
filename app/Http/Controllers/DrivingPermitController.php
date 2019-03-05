<?php

namespace App\Http\Controllers;
use Validator;
use App\Entities\DrivingPermit;

use Illuminate\Http\Request;

class DrivingPermitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $driving_permits = DrivingPermit::all();
        $message = 'No hay permisos de conducir registradas';
        return view('drivingPermit.index')->with(['drivingPermits' => $driving_permits, 'message' => $message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('drivingPermit.create')->with([]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $driving_permit = new DrivingPermit();
        $driving_permit->code = $request->input('code');
        $driving_permit->description = $request->input('description');
        $driving_permit->save();
        $request->session()->flash('alert-success', 'Permiso de conducir creado correctamente');
        return redirect()->route('permisos-conducir.index')->withInput();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $drivingPermit = DrivingPermit::findOrFail($id);
        return view('drivingPermit.edit')->with(['drivingPermit' => $drivingPermit]);
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
        $values = array('code','description');
        DrivingPermit::where('id',$id)->update($request->all($values));
        $request->session()->flash('alert-success', 'Permiso de conducir editado correctamente');
        return redirect()->route('permisos-conducir.index')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        DrivingPermit::destroy($id);
        $request->session()->flash('alert-success', 'Permiso de conducir eliminado correctamente');
        return redirect()->route('permisos-conducir.index')->withInput();
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
        DrivingPermit::destroy($id);
        $request->session()->flash('alert-success', 'Permiso de conducir eliminada correctamente');
        return redirect()->route('permisos-conducir.index');
    }
}
