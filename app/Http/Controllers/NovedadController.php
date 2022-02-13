<?php

namespace App\Http\Controllers;

use App\Novedad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NovedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courses = Auth::user()->courses;
        $id = $courses[0]->id; 
        if ($request->id != null) {
            $id = $request->id;
        }
        $novedades = Novedad::where('course_id',$id)->orderBy('id','DESC')->take(15)->get();
        foreach ($novedades as $key => $value) {
            $value->vistoUser(Auth::user()->id);       
        }
        $courses = \App\Course::all();
        return view('Novedades.index',['novedades' => $novedades, 'courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Novedades.form-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'course_id' => ['required'],        
        ]);
          
        Novedad::create([
            'titulo' => $request->titulo,
            'subtitulo' => $request->subtitulo,
            'url' => $request->url,
            'course_id' => $request->course_id,
        ]);

        return redirect()->back()->with('success', 'success');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Novedad  $novedad
     * @return \Illuminate\Http\Response
     */
    public function show(Novedad $novedad)
    {
        return 1;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Novedad  $novedad
     * @return \Illuminate\Http\Response
     */
    public function edit(Novedad $Novedad)
    {
        
        return view('Novedades.form-create',['novedad' => $Novedad]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Novedad  $novedad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Novedad $novedad)
    {
        $validator = $request->validate([
            'course_id' => ['required']
        ]);
        $novedad->titulo = $request->titulo;
        $novedad->subtitulo = $request->subtitulo;
        $novedad->course_id = $request->course_id;
        $novedad->save();
        return redirect()->route('Novedad.create')->with('success','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Novedad  $novedad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Novedad $novedad)
    {
        $novedad->delete();
        return redirect()->back();
    }

}
