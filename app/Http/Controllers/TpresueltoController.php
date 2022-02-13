<?php

namespace App\Http\Controllers;

use App\Tpresuelto;
use App\Score;
use App\Tp;
use App\Course;
use App\User;
use App\Unity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TpresueltoController extends Controller
{

    public function index()
    {
       $TpsEn = Tpresuelto::with('score','user')->get();
       $i = 0;
       $TpsEntregados = array();

       $TpsFinals = \App\TpFinalResuelto::where('estado', 'corrigiendo')->get();

       //return $TpsEn;
       foreach($TpsEn as $aux){
         if ($aux->score != null) {
           if ($aux->score->nota == 'corrigiendo') {
            $TpsEntregados[$i] = $aux;
            $i++;
           }
         }
       }
       $tps = Tp::all();
       $cursos = Course::with('unities')->get();
       $TpsNota = Tp::with('scores')->get();
       return view('correction', [
                                  'TpsFinals' => $TpsFinals,
                                  'TpsEntregados' => $TpsEntregados, 
                                  'TpsNota' => $TpsNota, 
                                  'tps' => $tps, 
                                  'cursos' => $cursos
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


    public function download(Request $request)
    {
        
        return Storage::download( $request['url']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      if($request->hasFile('tp')){

        $file = $request->file('tp');
        $name = $file->store('resoluciones');
        $tpresuelto = new Tpresuelto;
        $tpresuelto->url = $name;
        $tpresuelto->tp_id = $request['tp_id'];
        $tpresuelto->user_id = $request['id'];
        $tpresuelto->save();

        if(!$request['id_score']){
          $score = new Score;
          $score->nota = 'corrigiendo';
          $score->user_id = $request['id'];
          $score->tpresuelto_id = $tpresuelto->id;
          $score->tp_id = $request['tp_id'];
          $score->save();
        }else{
          $score = Score::find($request['id_score']);
          $score->nota = 'corrigiendo';
          $score->save();
        }

        return redirect()->back()->with('tpentregado', 'success');

      }
    }

    public function storeTpFinal(Request $request)
    {
      if($request->hasFile('tpFinal')){

        
        $file = $request->file('tpFinal');
        $name = $file->store('resoluciones');
        $tpresuelto = new \App\TpFinalResuelto;
        $tpresuelto->url = $name;
        $tpresuelto->tpF_id = $request['tpFinalId'];
        $tpresuelto->user_id = $request['user_id'];
        $tpresuelto->save();

        return redirect()->back()->with('tpentregado', 'success');
      }
      
    }

}
