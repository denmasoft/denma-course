<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Validator;
use App\Entities\Newsletter;
use App\Entities\Contract;

use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private function getNewsletters($newsletters){
        $data = array();
        foreach ($newsletters as $newsletter){
            $edit =  route('boletin-ofertas.edit',$newsletter->id);
            $delete = url('/panel/boletin-ofertas/'.$newsletter->id.'/remove');
            $nestedData['name'] = $newsletter->name;
            $nestedData['publishedAt'] = Carbon::createFromFormat('Y-m-d H:i:s',$newsletter->publishedAt)->format('d/m/Y');
            $nestedData['publishedIn'] = $newsletter->publishedIn;
            $nestedData['locality'] = $newsletter->locality;
            $nestedData['description'] = $newsletter->description;
            $nestedData['requirements'] = $newsletter->requirements;
            $contract = Contract::find($newsletter->contract_type);
            $nestedData['contract_type'] = $contract->nome;
            $nestedData['contact'] = $newsletter->contact;
            $nestedData['options'] = "&emsp;<a href='{$edit}' title='Edit' ><span class='glyphicon glyphicon-list'></span></a>
                                          &emsp;<a id='remove_link' href='{$delete}' title='Delete' ><span class='glyphicon glyphicon-edit'></span></a>";
            $data[] = $nestedData;
        }
        return $data;
    }
    public function listNewsletters(Request $request){
        $draw = $request->get('draw');
        $fields = array('id','name','publishedAt','publishedIn','locality','description','requirements','contract_type','contact');
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
            list($min,$max) = explode('-',$value);
            if(!empty($min) && !empty($max)){
                $sql = 'publishedAt>=? AND publishedAt<=?';
                array_push($query,$sql);
                array_push($params, $min);
                array_push($params, $max);
            }
            if(empty($max)){
                $sql = 'publishedAt>=?';
                array_push($query,$sql);
                array_push($params, $min);
            }
            if(empty($min)){
                $sql = 'publishedAt<=?';
                array_push($query,$sql);
                array_push($params, $max);
            }
        }
        if($colums[2]['search']['value']){
            $value = $colums[2]['search']['value'];
            array_push($query,'publishedIn like ?');
            array_push($params, '%'.$value.'%');

        }
        if($colums[3]['search']['value']){
            $value = $colums[3]['search']['value'];
            array_push($query,'locality like ?');
            array_push($params, '%'.$value.'%');
        }
        if($colums[4]['search']['value']){
            $value = $colums[4]['search']['value'];
            array_push($query,'description like ?');
            array_push($params, '%'.$value.'%');
        }
        if($colums[5]['search']['value']){
            $value = $colums[5]['search']['value'];
            array_push($query,'requirements like ?');
            array_push($params, '%'.$value.'%');
        }
        if($colums[6]['search']['value']){
            $value = $colums[6]['search']['value'];
            array_push($query,'contract_type IN (?)');
            array_push($params, '%'.$value.'%');
        }
        if($colums[7]['search']['value']){
            $value = $colums[7]['search']['value'];
            array_push($query,'contact like ?');
            array_push($params, '%'.$value.'%');
        }
        if(empty($search) && empty($query)){
            $total_newsletters = Newsletter::count();
            $newsletters = Newsletter::orderBy('name', 'ASC')->skip($start)->take($length)->get($fields);
        }
        else if(!empty($query)){
            $query = implode(' AND ',$query);
            $total_newsletters = Newsletter::whereRaw($query,$params)->count();
            $newsletters = Newsletter::whereRaw($query, $params)->offset($start)->limit($length)
                ->orderBy('name', 'ASC')->get($fields);
        }
        else{
            $total_newsletters = Newsletter::where('name','LIKE',"%{$search}%")
                ->orWhere('publishedAt', 'LIKE',"%{$search}%")
                ->orWhere('publishedIn', 'LIKE',"%{$search}%")
                ->orWhere('locality', 'LIKE',"%{$search}%")
                ->orWhere('description', 'LIKE',"%{$search}%")
                ->orWhere('requirements', 'LIKE',"%{$search}%")
                ->orWhere('contract_type', 'LIKE',"%{$search}%")
                ->orWhere('contact', 'LIKE',"%{$search}%")
                ->count();
            $newsletters =  Newsletter::where('name','LIKE',"%{$search}%")
                ->orWhere('publishedAt', 'LIKE',"%{$search}%")
                ->orWhere('publishedIn', 'LIKE',"%{$search}%")
                ->orWhere('locality', 'LIKE',"%{$search}%")
                ->orWhere('description', 'LIKE',"%{$search}%")
                ->orWhere('requirements', 'LIKE',"%{$search}%")
                ->orWhere('contract_type', 'LIKE',"%{$search}%")
                ->orWhere('contact', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($length)
                ->orderBy('name', 'ASC')
                ->get($fields);
        }
        $newsletters = $this->getNewsletters($newsletters);
        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_newsletters,
            'recordsFiltered' => $total_newsletters,
            'data' => $newsletters,
        );
        echo json_encode($data);
    }
    public function index(Request $request)
    {
        $contracts = Contract::all();
        $newsletters =Newsletter::orderBy('name', 'ASC')->paginate(25);
        return view('newsletter.index')->with(['contracts'=>$contracts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contracts = Contract::all();
        return view('newsletter.create')->with(['contracts'=>$contracts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newsletter = new Newsletter();
        $newsletter->name = $request->input('name');
        $newsletter->publishedAt = Carbon::createFromFormat('d/m/Y',$request->input('publishedAt'));
        $newsletter->publishedIn = $request->input('publisedIn');
        $newsletter->locality = $request->input('locality');
        $newsletter->description = $request->input('description');
        $newsletter->requirements = $request->input('requirements');
        $newsletter->contract_type = $request->input('contract_type');
        $newsletter->contact = $request->input('contact');
        $newsletter->save();
        $request->session()->flash('alert-success', 'Boletin de oferta creada correctamente');
        return redirect()->route('boletin-ofertas.index')->withInput();
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contracts = Contract::all();
        $newsletter = Newsletter::findOrFail($id);
        return view('newsletter.edit')->with(['newsletter' => $newsletter,'contracts'=>$contracts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$values = array('name','publishedAt','publishedIn','locality','description','requirements','contract_type','contact');
        $newsletter = Newsletter::where('id',$id);
        //$values['publishedAt'] = Carbon::createFromFormat('d/m/Y',$values['publishedAt']);
        //Newsletter::where('id',$id)->update($request->all($values));
        $values['name'] = $request->input('name');
        $values['publishedAt'] = Carbon::createFromFormat('d/m/Y',$request->input('publishedAt'));
        $values['publishedIn'] = $request->input('publishedIn');
        $values['locality'] = $request->input('locality');
        $values['description'] = $request->input('description');
        $values['requirements'] = $request->input('requirements');
        $values['contract_type'] = $request->input('contract_type');
        $values['contact'] = $request->input('contact');
        $newsletter->update($values);
        $request->session()->flash('alert-success', 'Boletin de oferta editada correctamente');
        return redirect()->route('boletin-ofertas.index')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Newsletter::destroy($id);
        $request->session()->flash('alert-success', 'Boletin de oferta eliminada correctamente');
        return redirect()->route('boletin-ofertas.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function show(Newsletter  $newsletter)
    {}
    public function remove(Request $request, $id)
    {
        Newsletter::destroy($id);
        $request->session()->flash('alert-success', 'Boletin de oferta eliminada correctamente');
        return redirect()->route('boletin-ofertas.index');
    }
}
