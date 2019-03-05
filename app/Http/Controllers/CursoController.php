<?php

namespace App\Http\Controllers;
use Validator;
use App\Entities\Curso;
use App\Entities\Puesto;
use App\Entities\Sector;
use App\Entities\User;

use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = "";
        $parametros = [];
        if($request->input('nombre') != null){       
            $query = "nombre like ? ";
            array_push($parametros, '%'.$request->input('nombre').'%');
        }
        if ($request->input('ubicacion') != null) {
            if(count($parametros)){
                $query .= "and ";
            }
            $query .= "lugar_celebracion like ? ";
            array_push($parametros, '%'.$request->input('ubicacion').'%');
        }
        if ($request->input('plazas')  != null) {
            if(count($parametros)){
                $query .= "and ";
            }
            $query .= "plazas_total > ? ";
            array_push($parametros, $request->input('plazas'));
        }     
        if ($request->input('plazas_disponibles')  != null) {
            if(count($parametros)){
                $query .= "and ";
            }
            $query .= "plazas_disponibles != ? ";
            array_push($parametros, 0);
        }    
        if ($request->input('edades_recomendadas')  != null) {
            if(count($parametros)){
                $query .= "and ";
            }
            $query .= "edades_recomendadas > ? ";
            array_push($parametros, $request->input('edades_recomendadas'));
        } 
        //dd(array($query,$parametros));
        if ($query != '') {
            $cursos = Curso::whereRaw($query, $parametros)->get();
            $mensaje_empty = "No se encontraron coincidencias";
        }else{
            $cursos = Curso::all();
            $mensaje_empty = "No hay cursos registrados";
        }


        return view('cursos.index')->with(['cursos' => $cursos, 'mensaje_empty' => $mensaje_empty]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectores = Sector::all();
        $puestos = Puesto::all();
        return view('cursos.create')->with(['sectores' => $sectores, 'puestos' => $puestos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fecha_inicio = strtotime($request->input('fecha_inicio'));
        $fecha_fin = strtotime($request->input('fecha_fin'));
        $diferencia_fechas = $fecha_fin - $fecha_inicio;
        $dias_diferencia = round($diferencia_fechas / (60 * 60 * 24));
        $hora_duracion = $dias_diferencia * $request->input('duracion_horas');

        $curso = new Curso();
        $curso->nombre = $request->input('nombre');
        $curso->lugar_celebracion = $request->input('lugar_celebracion');
        $curso->fecha_inicio = $request->input('fecha_inicio');
        $curso->fecha_fin = $request->input('fecha_fin');
        $curso->hora_inicio = $request->input('hora_inicio');
        $curso->hora_fin = $request->input('hora_fin');
        $curso->duracion_horas = $hora_duracion;
        $curso->plazas_total = $request->input('plazas_total');
        $curso->plazas_disponibles = $request->input('plazas_total');
        $curso->edades_recomendadas = $request->input('edades_recomendadas');
        $curso->pertenece_fie = true;//$request->input('pertenece_fie');
        $curso->contenido = $request->input('contenido');

        $mensajes = [
            'nombre.required' => 'Nombre es obligatoria',
            'lugar_celebracion.required' => 'Lugar_celebracion es obligatoria',
            'fecha_inicio.required' => 'Fecha Inicio es obligatoria',
            'fecha_inicio.date' => 'Fecha Inicio debe ser en formato dd/mm/yyyy',
            'fecha_fin.required' => 'Fecha Fin es obligatoria',
            'fecha_fin.date' => 'Fecha Fin debe ser en formato dd/mm/yyyy',
            'hora_inicio.required' => 'Hora Inicio es obligatoria',
            'hora_fin.required' => 'Hora Fin es obligatoria',
            'duracion_horas.required' => 'Duracion_horas es obligatoria',
            'plazas_total.required' => 'Plazas Total es obligatoria',
            'plazas_disponibles.required' => 'Plazas Disponibles es obligatoria',
            'edades_recomendadas.required' => 'Edades Recomendadas es obligatoria',
            'pertenece_fie.required' => 'Pertenece Fie es obligatoria',
            'contenido.required' => 'la descripcion larga es obligatoria',
        ];
        $reglas =  [
            'nombre' => 'required',
            'lugar_celebracion' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            //'duracion_horas' => 'required',
            'plazas_total' => 'required',
            //'plazas_disponibles' => 'required',
            'edades_recomendadas' => 'required',
            'pertenece_fie' => 'required',
            'contenido' => 'required',
        ];
        $validator = Validator::make($request->all(), $reglas, $mensajes);
        if ($validator->fails()) {
            return redirect('cursos/create')
                        ->withErrors($validator)
                        ->withInput();
        }        

        $puestos = $request->input('puestos');
        $puestos = (!isset($puestos)) ? array() : $puestos;   

        $curso->save();
        $curso->puestos()->sync($puestos);        
        $curso->sectores()->sync($request->input('sector'));
        
        $request->session()->flash('alert-success', 'Curso creado correctamente');
        return redirect()->route('cursos.show', $curso->id)->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        $sectores = Sector::all();
        $puestos = Puesto::all();
        return view('cursos.show')->with(['sectores' => $sectores, 'puestos' => $puestos, 'curso' => $curso]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {
        $sectores = Sector::all();
        $puestos = Puesto::all();
        return view('cursos.edit')->with(['sectores' => $sectores, 'puestos' => $puestos, 'curso' => $curso]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso)
    {
        $fecha_inicio = strtotime($request->input('fecha_inicio'));
        $fecha_fin = strtotime($request->input('fecha_fin'));
        $diferencia_fechas = $fecha_fin - $fecha_inicio;
        $dias_diferencia = round($diferencia_fechas / (60 * 60 * 24));
        $hora_duracion = $dias_diferencia * $request->input('duracion_horas');

        $curso = new Curso();
        $curso->nombre = $request->input('nombre');
        $curso->lugar_celebracion = $request->input('lugar_celebracion');
        $curso->fecha_inicio = $request->input('fecha_inicio');
        $curso->fecha_fin = $request->input('fecha_fin');
        $curso->hora_inicio = $request->input('hora_inicio');
        $curso->hora_fin = $request->input('hora_fin');
        $curso->duracion_horas = $hora_duracion;
        $curso->plazas_total = $request->input('plazas_total');
        $curso->plazas_disponibles = $request->input('plazas_total');
        $curso->edades_recomendadas = $request->input('edades_recomendadas');
        $curso->pertenece_fie = $request->input('pertenece_fie');
        $curso->contenido = $request->input('contenido');
        $mensajes = [
            'nombre.required' => 'Nombre es obligatoria',
            'lugar_celebracion.required' => 'Lugar_celebracion es obligatoria',
            'fecha_inicio.required' => 'Fecha Inicio es obligatoria',
            'fecha_inicio.date' => 'Fecha Inicio debe ser en formato dd/mm/yyyy',
            'fecha_fin.required' => 'Fecha Fin es obligatoria',
            'fecha_fin.date' => 'Fecha Fin debe ser en formato dd/mm/yyyy',
            'hora_inicio.required' => 'Hora Inicio es obligatoria',
            'hora_fin.required' => 'Hora Fin es obligatoria',
            'duracion_horas.required' => 'Duracion_horas es obligatoria',
            'plazas_total.required' => 'Plazas Total es obligatoria',
            'plazas_disponibles.required' => 'Plazas Disponibles es obligatoria',
            'edades_recomendadas.required' => 'Edades Recomendadas es obligatoria',
            'pertenece_fie.required' => 'Pertenece Fie es obligatoria',
            'contenido.required' => 'la descripcion larga es obligatoria',
        ];
        $reglas =  [
            'nombre' => 'required',
            'lugar_celebracion' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            //'duracion_horas' => 'required',
            'plazas_total' => 'required',
            //'plazas_disponibles' => 'required',
            'edades_recomendadas' => 'required',
            'pertenece_fie' => 'required',
            'contenido' => 'required',
        ];
        $validator = Validator::make($request->all(), $reglas, $mensajes);
        if ($validator->fails()) {
            return redirect('cursos/create')
                        ->withErrors($validator)
                        ->withInput();
        }        

        $puestos = $request->input('puestos');
        $puestos = (!isset($puestos)) ? array() : $puestos;
        $curso->save();


        $curso->puestos()->sync($puestos);        
        $curso->sectores()->sync($request->input('sector'));        
        $request->session()->flash('alert-success', 'Curso editado correctamente');
        

        return redirect()->route('cursos.edit', $curso->id)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        //
    }


    public function inscripcion($curso){
        $user = User::inRandomOrder()->first();
        $curso = Curso::find($curso);
        $sectores = Sector::all();
        $puestos = Puesto::all();   
        //dd($curso->puestos);
        return view('cursos.formularioInscripcion')->with(['sectores' => $sectores, 'puestos' => $puestos, 'curso' => $curso, 'user' => $user]);
    }

    public function inscribirme(Request $request, $curso){
        $curso = Curso::find($curso);
        $user = User::find($request->input('usuario'));
        if ($curso->plazas_disponibles > 0) {
            $curso->plazas_disponibles = $curso->plazas_disponibles - 1;
            try {
                $curso->users()->attach($user);
                $curso->save();
            } catch (Exception $e) {
                return "error";
            }            
        }else{
            $request->session()->flash('alert-danger', 'El curso al que intenta inscribirse, ye no tiene plazas desponibles');
            return redirect()->route('cursos.edit', $curso->id)->withInput();       
        }

        $request->session()->flash('alert-success', 'Se ha inscrito Exitosamente en el curso '.$curso->nombre);
        return redirect()->route('cursos.index', $curso->id);
    }

    public function confirmarInscripcion(Request $request, $curso){
      /*  $curso = Curso::find($curso);
        $user = User::find($request->input('usuario'));
        if ($curso->plazas_disponibles > 0) {
            $curso->plazas_disponibles = $curso->plazas_disponibles - 1;
            try {
                $curso->users()->attach($user);
                $curso->save();
            } catch (Exception $e) {
                return "error";
            }            
        }else{
            $request->session()->flash('alert-danger', 'El curso al que intenta inscribirse, ye no tiene plazas desponibles');
            return redirect()->route('cursos.edit', $curso->id)->withInput();       
        }



        $request->session()->flash('alert-success', 'Se ha inscrito Exitosamente en el curso '.$curso->nombre);
        return view('cursos.index');*/
    }
}
