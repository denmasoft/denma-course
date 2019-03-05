<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Queue\Jobs\Job;
use Validator;
use App\Entities\JobOffer;
use App\Entities\Contract;

use Illuminate\Http\Request;

class JobOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function getOffers($offers){
        $data = array();
        foreach ($offers as $offer){
            $edit =  route('ofertas.edit',$offer->id);
            $delete = url('/panel/ofertas/'.$offer->id.'/remove');
            $nestedData['requested_job'] = $offer->requested_job;
            $nestedData['vacancy'] = $offer->vacancy;
            $nestedData['tasks'] = $offer->tasks;
            $nestedData['due_date'] = $offer->due_date;
            $contract = Contract::find($offer->contract_type);
            $nestedData['contract_type'] = $contract?$contract->nome:'';
            $nestedData['start_date'] = $offer->start_date;
            $nestedData['duration'] = $offer->duration;
            $nestedData['locality'] = $offer->locality;
            $nestedData['hours'] = $offer->hours;
            $nestedData['salary'] = $offer->salary;
            $requirements = $offer->getRequirements()?implode(',',$offer->getRequirements()):'';
            $nestedData['requirements'] = '<p style="word-break: break-word;">'.$requirements.'</p>';
            $nestedData['options'] = "&emsp;<a href='{$edit}' title='Edit' ><span class='glyphicon glyphicon-list'></span></a>
                                          &emsp;<a id='remove_link' href='{$delete}' title='Delete' ><span class='glyphicon glyphicon-edit'></span></a>";
            $data[] = $nestedData;
        }
        return $data;
    }
    public function listOffers(Request $request){
        $draw = $request->get('draw');
        $fields = array('id','requested_job','vacancy','tasks','due_date','contract_type','start_date','duration','locality','hours','salary','requirements');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->input('search.value');
        $colums = $request->get('columns');
        $query = array();
        $params = [];
        if($colums[0]['search']['value']){
            $value = $colums[0]['search']['value'];
            array_push($query,'requested_job like ?');
            array_push($params, '%'.$value.'%');
        }
        if($colums[1]['search']['value']){
            $value = $colums[1]['search']['value'];
            array_push($query,'vacancy<= ?');
            array_push($params, '%'.$value.'%');
        }
        if($colums[2]['search']['value']){
            $value = $colums[2]['search']['value'];
            array_push($query,'tasks like ?');
            array_push($params, '%'.$value.'%');
        }
        if($colums[3]['search']['value']){
            $value = $colums[3]['search']['value'];
            list($min,$max) = explode('-',$value);
            if(!empty($min) && !empty($max)){
                $sql = 'due_date>=? AND due_date<=?';
                array_push($query,$sql);
                array_push($params, $min);
                array_push($params, $max);
            }
            if(empty($max)){
                $sql = 'due_date>=?';
                array_push($query,$sql);
                array_push($params, $min);
            }
            if(empty($min)){
                $sql = 'due_date<=?';
                array_push($query,$sql);
                array_push($params, $max);
            }
        }
        if($colums[4]['search']['value']){
            $value = $colums[4]['search']['value'];
            array_push($query,'contract_type IN (?)');
            array_push($params, '%'.$value.'%');
        }
        if($colums[5]['search']['value']){
            $value = $colums[5]['search']['value'];
            list($min,$max) = explode('-',$value);
            if(!empty($min) && !empty($max)){
                $sql = 'start_date>=? AND start_date<=?';
                array_push($query,$sql);
                array_push($params, $min);
                array_push($params, $max);
            }
            if(empty($max)){
                $sql = 'start_date>=?';
                array_push($query,$sql);
                array_push($params, $min);
            }
            if(empty($min)){
                $sql = 'start_date<=?';
                array_push($query,$sql);
                array_push($params, $max);
            }
        }
        if($colums[6]['search']['value']){
            $value = $colums[6]['search']['value'];
            list($min,$max) = explode('-',$value);
            if(!empty($min) && !empty($max)){
                $sql = 'duration>=? AND duration<=?';
                array_push($query,$sql);
                array_push($params, $min);
                array_push($params, $max);
            }
            if(empty($max)){
                $sql = 'duration>=?';
                array_push($query,$sql);
                array_push($params, $min);
            }
            if(empty($min)){
                $sql = 'duration<=?';
                array_push($query,$sql);
                array_push($params, $max);
            }

        }
        if($colums[7]['search']['value']){
            $value = $colums[7]['search']['value'];
            array_push($query,'locality like ?');
            array_push($params, '%'.$value.'%');
        }
        if($colums[8]['search']['value']){
            $value = $colums[8]['search']['value'];
            list($min,$max) = explode('-',$value);
            if(!empty($min) && !empty($max)){
                $sql = 'salary>=? AND salary<=?';
                array_push($query,$sql);
                array_push($params, $min);
                array_push($params, $max);
            }
            if(empty($max)){
                $sql = 'salary>=?';
                array_push($query,$sql);
                array_push($params, $min);
            }
            if(empty($min)){
                $sql = 'salary<=?';
                array_push($query,$sql);
                array_push($params, $max);
            }

        }
        if(empty($search) && empty($query)){
            $total_offers = JobOffer::count();
            $offers = JobOffer::orderBy('requested_job', 'ASC')->skip($start)->take($length)->get($fields);
        }
        else if(!empty($query)){
            $query = implode(' AND ',$query);
            $total_offers = JobOffer::whereRaw($query,$params)->count();
            $offers = JobOffer::whereRaw($query, $params)->offset($start)->limit($length)
                ->orderBy('requested_job', 'ASC')->get($fields);
        }
        else{
            $total_offers = JobOffer::where('requested_job','LIKE',"%{$search}%")
                ->orWhere('vacancy', 'LIKE',"%{$search}%")
                ->orWhere('tasks', 'LIKE',"%{$search}%")
                ->orWhere('due_date', 'LIKE',"%{$search}%")
                ->orWhere('contract_type', 'LIKE',"%{$search}%")
                ->orWhere('start_date', 'LIKE',"%{$search}%")
                ->orWhere('duration', 'LIKE',"%{$search}%")
                ->orWhere('locality', 'LIKE',"%{$search}%")
                ->orWhere('hours', 'LIKE',"%{$search}%")
                ->orWhere('salary', 'LIKE',"%{$search}%")
                ->orWhere('requirements', 'LIKE',"%{$search}%")
                ->count();
            $offers =  JobOffer::where('requested_job','LIKE',"%{$search}%")
                ->orWhere('vacancy', 'LIKE',"%{$search}%")
                ->orWhere('tasks', 'LIKE',"%{$search}%")
                ->orWhere('due_date', 'LIKE',"%{$search}%")
                ->orWhere('contract_type', 'LIKE',"%{$search}%")
                ->orWhere('start_date', 'LIKE',"%{$search}%")
                ->orWhere('duration', 'LIKE',"%{$search}%")
                ->orWhere('locality', 'LIKE',"%{$search}%")
                ->orWhere('hours', 'LIKE',"%{$search}%")
                ->orWhere('salary', 'LIKE',"%{$search}%")
                ->orWhere('requirements', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($length)
                ->orderBy('requested_job', 'ASC')
                ->get($fields);
        }
        $offers = $this->getOffers($offers);
        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_offers,
            'recordsFiltered' => $total_offers,
            'data' => $offers,
        );
        echo json_encode($data);
    }
    public function index(Request $request)
    {
        $contracts = Contract::all();
        $offers =JobOffer::orderBy('requested_job', 'ASC')->paginate(25);
        return view('job_offer.index')->with(['contracts'=>$contracts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contracts = Contract::all();
        return view('job_offer.create')->with(['contracts'=>$contracts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $job_offer = new JobOffer();
        $job_offer->requested_job = $request->input('requested_job');
        $job_offer->vacancy = $request->input('vacancy');
        $job_offer->tasks = $request->input('tasks');
        $job_offer->due_date = Carbon::createFromFormat('d/m/Y', $request->input('due_date'))->format('d/m/Y');
        $job_offer->contract_type = $request->input('contract_type');
        $job_offer->start_date = Carbon::createFromFormat('d/m/Y', $request->input('start_date'))->format('d/m/Y');
        $job_offer->duration = $request->input('duration');
        $job_offer->locality = $request->input('locality');
        $job_offer->hours = $request->input('hours');
        $job_offer->salary = $request->input('salary');
        $job_offer->requirements = serialize($request->input('requirements'));
        $job_offer->save();
        $request->session()->flash('alert-success', 'Oferta creada correctamente');
        return redirect()->route('ofertas.index')->withInput();
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobOffer  $job_offer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contracts = Contract::all();
        $job_offer = JobOffer::findOrFail($id);
        $requirements = $job_offer->getRequirements();
        $experience = false;
        $training = false;
        $others = false;
        $others_text = '';
        $expkey = array_search('experience',$requirements);
        $traikey = array_search('training',$requirements);
        if($expkey!==false){
            $experience = true;
            //$key = array_search('Experiencia',$requirements);
            array_splice($requirements,$expkey,1);
        }
        if($traikey!==false){
            $training = true;
            //$key = array_search('training',$requirements);
            array_splice($requirements,$traikey,1);
        }
        if($requirements[0]){
            $others = true;
            $others_text =$requirements[0];
        }
        return view('job_offer.edit')->with(['others'=>$others,'others_text'=>$others_text,'training'=>$training,'experience'=>$experience,'job_offer' => $job_offer,'contracts'=>$contracts,'requirements'=>$requirements]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobOffer  $job_offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$values = array('requested_job','vacancy','tasks','due_date','contract_type','start_date','duration','locality','hours','salary','requirements');
        $jobOffer = JobOffer::where('id',$id);
        $values['requested_job'] = $request->input('requested_job');
        $values['vacancy'] = $request->input('vacancy');
        $values['tasks'] = $request->input('tasks');
        $values['due_date'] = Carbon::createFromFormat('d/m/Y',$request->input('due_date'));
        $values['contract_type'] = $request->input('contract_type');
        $values['start_date'] = Carbon::createFromFormat('d/m/Y',$request->input('start_date'));
        $values['duration'] = $request->input('duration');
        $values['locality'] = $request->input('locality');
        $values['hours'] = $request->input('hours');
        $values['salary'] = $request->input('salary');
        $values['requirements'] = serialize($request->input('requirements'));
        $jobOffer->update($values);
        $request->session()->flash('alert-success', 'Oferta editada correctamente');
        return redirect()->route('ofertas.index')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobOffer  $job_offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        JobOffer::destroy($id);
        $request->session()->flash('alert-success', 'Oferta eliminadas correctamente');
        return redirect()->route('ofertas.index')->withInput();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\JobOffer  $job_offer
     * @return \Illuminate\Http\Response
     */
    public function show(JobOffer  $job_offer)
    {}
    public function remove(Request $request, $id)
    {
        JobOffer::destroy($id);
        $request->session()->flash('alert-success', 'Oferta eliminada correctamente');
        return redirect()->route('ofertas.index');
    }
}
