<?php

namespace App\Http\Controllers;

use App\Consulta;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultaController extends Controller
{
    public function index()
    {
        $consultas = Consulta::where('id','>',0)->orderBy('id','DESC')->take(10)->get();

        foreach ($consultas as $consulta ) {
            $consulta->visto = 1;
            $consulta->save();
        }
        
        return view('consultas.index', ['consultas' => $consultas]);
    }

    /**
     * Carga la consulta desde react
     */
    public function loadConsulta(Request $request)
    {
        try{
            $consulta = new Consulta;

            $consulta->consulta = $request->consulta;
            $consulta->user_id = Auth::user()->id;

            $consulta->save();

            $estado = ['estado' => 1];
        }catch(\Throwable $th) {
            $estado = ['estado' => 0, 'error' => $th];
        }

        return $estado;
    }
}
