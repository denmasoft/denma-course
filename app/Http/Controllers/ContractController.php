<?php

namespace App\Http\Controllers;
use Validator;
use App\Entities\Contract;

use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contracts = Contract::all();
        $message = 'No hay puestos registradas';
        return view('contract.index')->with(['contracts' => $contracts, 'message' => $message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contract.create')->with([]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contract = new Contract();
        $contract->nombre = $request->input('name');
        $contract->nome = $request->input('name_gl');
        $contract->save();
        $request->session()->flash('alert-success', 'Contrato creado correctamente');
        return redirect()->route('contratos.index')->withInput();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contract = Contract::findOrFail($id);
        return view('contract.edit')->with(['contract' => $contract]);
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
        $values = array('nombre','nome');
        Contract::where('id',$id)->update($request->all($values));
        $request->session()->flash('alert-success', 'Contrato editado correctamente');
        return redirect()->route('contratos.index')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Contract::destroy($id);
        $request->session()->flash('alert-success', 'Contrato eliminado correctamente');
        return redirect()->route('contratos.index')->withInput();
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
        Contract::destroy($id);
        $request->session()->flash('alert-success', 'Contrato eliminada correctamente');
        return redirect()->route('contratos.index');
    }
}
