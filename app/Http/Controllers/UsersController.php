<?php

namespace App\Http\Controllers;

use App\Entities\Concello;
use App\Entities\Sector;
use App\Entities\User;
use App\Entities\Grade;
use App\Entities\Puesto;
use App\Entities\Language;
use App\Entities\Province;
use App\Entities\DrivingPermit;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    private function getUsers($users){
        /*$fields = array('surname','name','email','cif','telephone','pk','birth');
        if(empty($search))
        {
            $users = User::orderBy('surname', 'ASC')->skip($start)->take($length)->get($fields);
        }
        else{
            $users =  User::where('name','LIKE',"%{$search}%")
                ->orWhere('cif', 'LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->orWhere('telephone', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($length)
                ->orderBy('surname', 'ASC')
                ->get($fields);
        }*/
        $data = array();

        foreach ($users as $user){
            $edit =  url('/panel/usuarios/'.$user->pk.'/edit');//route('usuarios.edit',$user->pk);
            $delete = url('/panel/usuarios/'.$user->pk.'/remove'); //route('usuarios.destroy',$user->pk);
            $nestedData['surname'] = $user->surname;
            $nestedData['name'] = $user->name;
            $nestedData['age'] = Carbon::createFromFormat('Y-m-d', $user->birth)->age;
            $nestedData['email'] = $user->email;
            $nestedData['cif'] = $user->cif;
            $nestedData['telephone'] = $user->telephone;
            $nestedData['options'] = "&emsp;<a href='{$edit}' title='Edit' ><span class='glyphicon glyphicon-list'></span></a>
                                          &emsp;<a id='remove_link' href='{$delete}' title='Delete' ><span class='glyphicon glyphicon-edit'></span></a>";
            $data[] = $nestedData;
        }
        return $data;
    }
    public function listUsers(Request $request){
        $draw = $request->get('draw');
        $fields = array('surname','name','email','cif','telephone','pk','birth');
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
            array_push($query,'surname like ?');
            array_push($params, '%'.$value.'%');
        }
        if($colums[2]['search']['value']){
            $value = $colums[2]['search']['value'];
            array_push($query,'cif like ?');
            array_push($params, '%'.$value.'%');
        }
        if($colums[3]['search']['value']){
            $value = $colums[3]['search']['value'];
            array_push($query,'email like ?');
            array_push($params, '%'.$value.'%');
        }
        if($colums[4]['search']['value']){
            $value = $colums[4]['search']['value'];
            array_push($query,'telephone like ?');
            array_push($params, '%'.$value.'%');
        }
        if($colums[5]['search']['value']){
            $value = $colums[5]['search']['value'];
            list($min,$max) = explode('-',$value);
            if(!empty($min) && !empty($max)){
                $sql = 'TIMESTAMPDIFF(YEAR, birth, CURDATE()) BETWEEN ? AND ?';
                array_push($query,$sql);
                array_push($params, $min);
                array_push($params, $max);
            }
            if(empty($max)){
                $sql = 'TIMESTAMPDIFF(YEAR, birth, CURDATE())>=?';
                array_push($query,$sql);
                array_push($params, $min);
            }
            if(empty($min)){
                $sql = 'TIMESTAMPDIFF(YEAR, birth, CURDATE())<=?';
                array_push($query,$sql);
                array_push($params, $max);
            }
        }
        if(empty($search) && empty($query)){
            $total_users = User::count();
            $users = User::orderBy('surname', 'ASC')->skip($start)->take($length)->get($fields);
        }
        else if(!empty($query)){
            $query = implode(' AND ',$query);
            $total_users = User::whereRaw($query,$params)->count();
            $users = User::whereRaw($query, $params)->offset($start)->limit($length)
                ->orderBy('surname', 'ASC')->get($fields);
        }
        else{
            $total_users = User::where('name','LIKE',"%{$search}%")
                ->orWhere('cif', 'LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->orWhere('telephone', 'LIKE',"%{$search}%")
                ->count();
            $users =  User::where('name','LIKE',"%{$search}%")
                ->orWhere('cif', 'LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->orWhere('telephone', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($length)
                ->orderBy('surname', 'ASC')
                ->get($fields);
        }
        $users = $this->getUsers($users);
        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_users,
            'recordsFiltered' => $total_users,
            'data' => $users,
        );
        echo json_encode($data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =User::orderBy('surname', 'ASC')->paginate(25);
        /*$html = '<h1>Hello world</h1>';
        $pdf = new TCPDF();
        $pdf::SetTitle('Hello World');
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output('hello_world.pdf');*/
        //return Excel::download(new UsersExport, 'users.xlsx');
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::all();
        $jobPosts = Puesto::all();
        $langs = Language::all();
        $sectors = Sector::all();
        $provinces = Province::all();
        $permits = DrivingPermit::all();
        return view('users.create')->with(['permits'=>$permits,'provinces'=>$provinces,'grades'=>$grades,'jobPosts'=>$jobPosts,'langs'=>$langs,'sectors'=>$sectors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $other_province = $request->input('other_province');
        $other_hall = $request->input('other_hall');
        if($other_province!=''){
            $province = Province::firstOrNew(array('name' => $other_province));
            $province->name = $other_province;
            $province->country_fk = 'ES';
            $province->save();
        }
        if($other_hall!=''){
            $hall = Concello::firstOrNew(array('name' => $other_hall));
            $hall->name = $other_hall;
            $hall->province_pk = $province->pk;
            $hall->save();
        }
        $user = new User();
        $user->name = $request->input('name');
        $user->surname = $request->input('last_name');
        $user->nif = $request->input('dni');
        $user->sex = $request->input('gender');
        $user->birth = $request->input('birth');
        $user->province_fk = isset($other_province)?$province->pk:$request->input('province');
        $user->city_hall = isset($other_hall)?$hall->id:$request->input('hall');
        $user->country_fk = 'ES';
        $user->address = $request->input('address');
        $user->zip = $request->input('postal_code');
        $user->telephone = $request->input('phone');
        $user->disability =  $request->input('disability')==='on'?1:0;
        $user->sector = serialize($request->input('sectors'));
        $user->other_phone = $request->input('other_phone');
        $user->email = $request->input('email');
        $user->driving_permit = serialize($request->input('driving_permit'));
        $user->languages = $request->input('languages');
        $user->computer_skills = $request->input('computer_skills');
        $user->other_courses = $request->input('others_courses');
        $no_experience = $request->input('no_experience');
        $user->job_posts = $no_experience!=='on'?$request->input('job_posts'):null;
        $user->posts = $request->input('posts');
        $user->study = $request->input('studies');
        $user->specialty = $request->input('specialty');
        $user->save();
        $request->session()->flash('alert-success', 'Usuario creado correctamente');
        return redirect()->route('usuarios.index')->withInput();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grades = Grade::all();
        $jobPosts = Puesto::all();
        $langs = Language::all();
        $sectors = Sector::all();
        $provinces = Province::all();
        $user = User::findOrFail($id);
        $permits = DrivingPermit::all();
        $user_permit = explode(',',unserialize($user->driving_permit));
        $user_permit = implode(',',$user_permit);
        $user_sector = implode(',',unserialize($user->sector));
        $province = Province::findorFail($user->province_fk);
        $concellos = $province->concellos;
        $user_concello = $user->city_hall;

        $study = Grade::findorFail($user->study);
        $speciaties = $study->Specialties;
        $user_specialty = $user->specialty;
        $show = ($user->study==='1' || $user->study==='2' || $user->study==='3')?'none':'block';
        return view('users.edit')->with(['show'=>$show,'user_specialty'=>$user_specialty,'specialties'=>$speciaties,'user_concello'=>$user_concello,'concellos'=>$concellos,'user_sector'=>$user_sector,'user_permit'=>$user_permit,'permits'=>$permits,'user'=>$user,'provinces'=>$provinces,'grades'=>$grades,'jobPosts'=>$jobPosts,'langs'=>$langs,'sectors'=>$sectors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //$values = array('name','last_name','dni','gender','birth','province','address','postal_code','phone');
        $other_province = $request->input('other_province');
        $other_hall = $request->input('other_hall');
        if($other_province!=''){
            $province = Province::firstOrNew(array('name' => $other_province));
            $province->name = $other_province;
            $province->country_fk = 'ES';
            $province->save();
        }
        if($other_hall!=''){
            $hall = Concello::firstOrNew(array('name' => $other_hall));
            $hall->name = $other_hall;
            $hall->province_pk = $province->pk;
            $hall->save();
        }
        $user = new User();
        $user->exists = true;
        $user->pk = $id;
        $user->name = $request->input('name');
        $user->surname = $request->input('last_name');
        $user->nif = $request->input('dni');
        $user->sex = $request->input('gender');
        $user->birth = $request->input('birth');
        $user->province_fk = isset($other_province)?$province->pk:$request->input('province');
        $user->city_hall = isset($other_hall)?$hall->id:$request->input('hall');
        $user->country_fk = 'ES';
        $user->address = $request->input('address');
        $user->zip = $request->input('postal_code');
        $user->telephone = $request->input('phone');
        $user->disability =  $request->input('disability')==='on'?1:0;
        $user->sector = serialize($request->input('sectors'));
        $user->other_phone = $request->input('other_phone');
        $user->email = $request->input('email');
        $user->driving_permit = serialize($request->input('driving_permit'));
        $user->languages = $request->input('languages');
        $user->computer_skills = $request->input('computer_skills');
        $user->other_courses = $request->input('others_courses');
        $no_experience = $request->input('no_experience');
        $user->job_posts = $no_experience!=='on'?$request->input('job_posts'):null;
        $user->posts = $request->input('posts');
        $user->study = $request->input('studies');
        $user->specialty = $request->input('specialty');
        $user->save();

        //User::where('id',$id)->update($request->all($values));

        $request->session()->flash('alert-success', 'Usuario editado correctamente');
        return redirect()->route('usuarios.index')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        User::destroy($id);
        $request->session()->flash('alert-success', 'Usuario eliminado correctamente');
        return redirect()->route('usuarios.index');
    }
    public function remove(Request $request, $id)
    {
        User::destroy($id);
        $request->session()->flash('alert-success', 'Usuario eliminada correctamente');
        return redirect()->route('usuarios.index');
    }
}
