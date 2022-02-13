<?php

namespace App\Http\Controllers;

use App\Objetivo;
use Illuminate\Http\Request;

class ObjetivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objetivoGeneral = Objetivo::getObjMonth();
        
        return view('objetivo.objetivo', [
                                            'objetivoGeneral' => $objetivoGeneral,
                                        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    public function getObjetivo()
    {
        $objetivoGeneral = Objetivo::getObjMonth();
        return $objetivoGeneral;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Objetivo  $objetivo
     * @return \Illuminate\Http\Response
     */
    public function deleteCustom(\App\ObjetivoCustom $custom)
    {
        $custom->delete();

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Objetivo  $objetivo
     * @return \Illuminate\Http\Response
     */
    public function edit(Objetivo $objetivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Objetivo  $objetivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $objetivo = Objetivo::find($request->id);

        $objetivo->referencia = $request->referencia;
        $objetivo->cantidad_cursos = $request->cantidad_cursos;

        $objetivo->save();

        return redirect()->route('Admin.index')->with('msg', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Objetivo  $objetivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Objetivo $objetivo)
    {
        //
    }
}
