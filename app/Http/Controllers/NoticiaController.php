<?php

namespace App\Http\Controllers;
use Validator;
use App\Entities\Noticia;

use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $news = Noticia::all();
        $message = 'No hay noticias registradas';
        return view('news.index')->with(['news' => $news, 'message' => $message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create')->with([]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $noticia = new Noticia();
        $noticia->titulo = $request->input('titulo');
        $noticia->antetitulo = $request->input('antetitulo');
        $noticia->entradilla = $request->input('entradilla');
        $noticia->noticia = $request->input('noticia');
        $noticia->fecha_publicacion = $request->input('fecha_publicacion');
        $noticia->fecha_expiracion = $request->input('fecha_expiracion');
        $imagen_destacada = $request->file('imagen_destacada');
        $slug = str_slug($request->input('titulo'), '-');
        $imagen_destacada_str = $slug.'_imagen_destacada.'.$imagen_destacada->getClientOriginalExtension();
        $destinationPath = public_path('/noticias');
        $imagen_destacada->move($destinationPath, $imagen_destacada_str);
        $imagen_1 = $request->file('imagen_1');
        $imagen_1_str = $slug.'_imagen1.'.$imagen_1->getClientOriginalExtension();
        $destinationPath = public_path('/noticias');
        $imagen_1->move($destinationPath, $imagen_1_str);
        $imagen_2 = $request->file('imagen_2');
        $imagen_2_str = $slug.'_imagen2.'.$imagen_2->getClientOriginalExtension();
        $destinationPath = public_path('/noticias');
        $imagen_2->move($destinationPath, $imagen_2_str);
        $noticia->imagen_destacada = $slug.'_imagen_destacada.';
        $noticia->imagen_1 = $slug.'_imagen_1.';
        $noticia->imagen_2 = $slug.'_imagen_2.';
        $noticia->save();
        $request->session()->flash('alert-success', 'Noticia creada correctamente');
        return redirect()->route('noticias.index')->withInput();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $noticia = Noticia::findOrFail($id);
        return view('news.edit')->with(['noticia' => $noticia]);
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
        $values = array('titulo','antetitulo','entradilla','noticia','fecha_publicacion','fecha_expiracion');
        $noticia = Noticia::where('id',$id);
        $imagen_destacada = $request->file('imagen_destacada');
        $slug = str_slug($request->input('titulo'), '-');
        $imagen_destacada_str = $slug.'_imagen_destacada.'.$imagen_destacada->getClientOriginalExtension();
        $destinationPath = public_path('/noticias');
        $imagen_destacada->move($destinationPath, $imagen_destacada_str);
        $imagen_1 = $request->file('imagen_1');
        $imagen_1_str = $slug.'_imagen1.'.$imagen_1->getClientOriginalExtension();
        $destinationPath = public_path('/noticias');
        $imagen_1->move($destinationPath, $imagen_1_str);
        $imagen_2 = $request->file('imagen_2');
        $imagen_2_str = $slug.'_imagen2.'.$imagen_2->getClientOriginalExtension();
        $destinationPath = public_path('/noticias');
        $imagen_2->move($destinationPath, $imagen_2_str);
        $noticia->imagen_destacada = $slug.'_imagen_destacada.';
        $noticia->imagen_1 = $slug.'_imagen_1.';
        $noticia->imagen_2 = $slug.'_imagen_2.';
        $noticia->update($request->all($values));
        $request->session()->flash('alert-success', 'Noticia editada correctamente');
        return redirect()->route('noticias.index')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Noticia::destroy($id);
        $request->session()->flash('alert-success', 'Noticia eliminado correctamente');
        return redirect()->route('noticias.index')->withInput();
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
        Noticia::destroy($id);
        $request->session()->flash('alert-success', 'Noticia eliminada correctamente');
        return redirect()->route('noticias.index');
    }
}