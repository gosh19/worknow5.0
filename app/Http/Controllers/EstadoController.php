<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Estado;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function habiztarr(Request $request)
    {
      $estado = Estado::find($request['id']);
      $id = $_GET['id'];
      if($estado==null){
        return view('cargarEstado', ['user_id', $id]);
      }
      $hoy = Carbon::now();
      $hoy->day = $hoy->day+5;
      $hoy = $hoy->format('Y-m-d');
      $estado->fecha_siguiente_cobro = $hoy;
      $estado->save();
      return redirect()->back()->with('habiztado', 'success');
    }
    /**
    * HABIZTADO PARA REACT
    */
    public function habiztar(Request $request)
    {
      $estado = Estado::find($request['user_id']);
      if($estado==null){
        return "Debe Crear un estado";
      }
      $hoy = Carbon::now();
      $hoy->day = $hoy->day+5;
      $hoy = $hoy->format('Y-m-d');
      $estado->fecha_siguiente_cobro = $hoy;
      $estado->save();
      return $hoy;
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

        $estado = new Estado;
        $estado->id = $request['user_id'];
        $estado->user_id = $request['user_id'];
        $estado->tipo = $request['tipo'];
        $estado->valor_cuota = $request['valor'];
        $estado->cant_cuotas = $request['cant_cuotas'];
        $estado->cuotas_pagas = $request['cuotas_pagas'];
        $estado->valor_restante = $request['valor_restante'];
        $estado->fecha_siguiente_cobro = $request['fecha_siguiente_cobro'];
        $estado->save();
        return redirect()->back()->with('creado', 'succcess');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function show(Estado $estado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit(Estado $estado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estado $estado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estado $estado)
    {
        //
    }
}
