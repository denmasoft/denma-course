<?php

namespace App\Http\Controllers;
use Validator;
use App\Entities\Enterprise;

use Illuminate\Http\Request;

class EnterpriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private function getEnterprises($enterprises){
        $data = array();
        foreach ($enterprises as $enterprise){
            $edit =  route('empresas.edit',$enterprise->id);
            $delete = url('/panel/empresas/'.$enterprise->id.'/remove');
            $nestedData['name'] = $enterprise->name;
            $nestedData['social'] = $enterprise->social;
            $nestedData['cif'] = $enterprise->nif;
            $nestedData['contact'] = $enterprise->contact;
            $nestedData['phone'] = $enterprise->phone;
            $nestedData['email'] = $enterprise->email;
            $nestedData['position'] = $enterprise->position;
            $nestedData['approval'] = $enterprise->approval;
            $nestedData['options'] = "&emsp;<a href='{$edit}' title='Edit' ><span class='glyphicon glyphicon-list'></span></a>
                                          &emsp;<a id='remove_link' href='{$delete}' title='Delete' ><span class='glyphicon glyphicon-edit'></span></a>";
            $data[] = $nestedData;
        }
        return $data;
    }
    public function listEnterprises(Request $request){
        $draw = $request->get('draw');
        $fields = array('id','name','social','nif','contact','phone','email');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->input('search.value');
        $colums = $request->get('columns');
        $query = array();
        $params = [];
        if($colums[0]['search']['value']){
            $value = $colums[0]['search']['value'];
            array_push($query,'name like ?');
            array_push($params, '%'.$value.'%');
        }
        if($colums[1]['search']['value']){
            $value = $colums[1]['search']['value'];
            array_push($query,'social like ?');
            array_push($params, '%'.$value.'%');
        }
        if($colums[2]['search']['value']){
            $value = $colums[2]['search']['value'];
            array_push($query,'nif like ?');
            array_push($params, '%'.$value.'%');
        }
        if($colums[3]['search']['value']){
            $value = $colums[3]['search']['value'];
            array_push($query,'contact like ?');
            array_push($params, '%'.$value.'%');
        }
        if($colums[4]['search']['value']){
            $value = $colums[4]['search']['value'];
            array_push($query,'phone like ?');
            array_push($params, '%'.$value.'%');
        }
        if($colums[5]['search']['value']){
            $value = $colums[5]['search']['value'];
            array_push($query,'email like ?');
            array_push($params, '%'.$value.'%');
        }
        if($colums[6]['search']['value']){
            $value = $colums[6]['search']['value'];
            array_push($query,'position like ?');
            array_push($params, '%'.$value.'%');
        }
        if(empty($search) && empty($query)){
            $total_enterprises = Enterprise::count();
            $enterprises = Enterprise::orderBy('name', 'ASC')->skip($start)->take($length)->get($fields);
        }
        else if(!empty($query)){
            $query = implode(' AND ',$query);
            $total_enterprises = Enterprise::whereRaw($query,$params)->count();
            $enterprises = Enterprise::whereRaw($query, $params)->offset($start)->limit($length)
                ->orderBy('name', 'ASC')->get($fields);
        }
        else{
            $total_enterprises = Enterprise::where('name','LIKE',"%{$search}%")
                ->orWhere('cif', 'LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->orWhere('telephone', 'LIKE',"%{$search}%")
                ->count();
            $enterprises =  Enterprise::where('name','LIKE',"%{$search}%")
                ->orWhere('cif', 'LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->orWhere('telephone', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($length)
                ->orderBy('name', 'ASC')
                ->get($fields);
        }
        $enterprises = $this->getEnterprises($enterprises);
        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_enterprises,
            'recordsFiltered' => $total_enterprises,
            'data' => $enterprises,
        );
        echo json_encode($data);
    }
    public function index(Request $request)
    {
        /*$query = "";
        $parameters = [];
        if($request->input('name') != null){       
            $query = "name like ? ";
            array_push($parameters, '%'.$request->input('name').'%');
        }
        if ($request->input('social') != null) {
           
            $query .= "social like ? ";
            array_push($parameters, '%'.$request->input('social').'%');
        }
        if ($request->input('nif')  != null) {
           
            $query .= "nif like ? ";
            array_push($parameters, $request->input('nif'));
        }     
        if ($request->input('approval')  != null) {
            
            $query .= "approval = ? ";
            array_push($parameters, $request->input('approval')==true?1:0);
        }    
        
        if ($query != '') {
            $enterprises = Enterprise::whereRaw($query, $parameters)->get();
            $message = "No results";
        }else{
            $enterprises = Enterprise::all();
            $message = "No hay empresas registradas";
        }*/
        $enterprises =Enterprise::orderBy('name', 'ASC')->paginate(25);

        return view('enterprise.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('enterprise.create')->with([]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $enterprise = new Enterprise();
        $enterprise->name = $request->input('name');
        $enterprise->social = $request->input('social');
        $enterprise->nif = $request->input('nif');
        $enterprise->contact = $request->input('contact');
        $enterprise->position = $request->input('position');
        $enterprise->phone = $request->input('phone');
        $enterprise->email = $request->input('email');
        $enterprise->approval = $request->input('approval')==true?1:0;
        $enterprise->save();
        $request->session()->flash('alert-success', 'Empresa creada correctamente');
        return redirect()->route('empresas.index')->withInput();
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $enterprise = Enterprise::findOrFail($id);
        return view('enterprise.edit')->with(['enterprise' => $enterprise]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $values = array('name','social','nif','contact','position','phone','email','approval');

        Enterprise::where('id',$id)->update($request->all($values));
        /*$enterprise->name = $request->input('name');
        $enterprise->social = $request->input('social');
        $enterprise->nif = $request->input('nif');
        $enterprise->contact = $request->input('contact');
        $enterprise->position = $request->input('position');
        $enterprise->phone = $request->input('phone');
        $enterprise->email = $request->input('email');
        $enterprise->approval = $request->input('approval')==true?1:0;
        $enterprise->save();*/
        $request->session()->flash('alert-success', 'Empresa editada correctamente');
        return redirect()->route('empresas.index')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Enterprise::destroy($id);
        $request->session()->flash('alert-success', 'Empresa eliminada correctamente');
        return redirect()->route('empresas.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function show(Enterprise  $enterprise)
    {}
    public function remove(Request $request, $id)
    {
        Enterprise::destroy($id);
        $request->session()->flash('alert-success', 'Empresa eliminada correctamente');
        return redirect()->route('empresas.index');
    }
}
