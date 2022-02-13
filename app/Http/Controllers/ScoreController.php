<?php

namespace App\Http\Controllers;

use App\Score;
use App\User;
use App\Tpresuelto;
use App\Tp;
use App\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use App\Mail\AlumnosMail;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scores = Tpresuelto::with('scores')->get();
        return view('tpscorregidos', ['scores' => $scores]);
    }

    public function aprobar(Request $request)
    {
        $score = Score::find($request['id_score']);
        $score->nota_numerica = $request->nota_numerica;
        if ($request->nota_numerica >= 7) {
            $score->nota = 'aprobado';
            $case = 'tpAprobado';
            $tipo = 'success';
        }else{
            $score->nota = 'desaprobado';
            $case = 'tpDesaprobado';
            $tipo = 'danger';
        }
        $request->tp = $score->tp;

        $score->save();

        $user = User::find($request['user_id']);

        $unity = Tp::find( $score->tp_id)->unity()->get();
        if ($unity != []) {
            $unity = $unity[0];
            $course = \App\Unity::find($unity->id)->courses()->get();
            if ($course != []) {
                $course = $course[0];
                $notification = \App\Notification::where([
                                                        ['user_id', $request->user_id],
                                                        ['unity_id',$unity->id],
                                                        ['course_id',$course->id]
                                                        ])->get();
                if (count($notification) == 0) {
                    $notification = new \App\Notification;
                    $notification->user_id = $request->user_id;
                    $notification->tipo = "unidad";
                    $notification->course_id = $course->id;
                    $notification->unity_id = $unity->id;

                }else{
                    $notification = $notification[0];
                    $notification->visto = 0;    
                }
                $notification->save();
            }
        }

        try {

            Mail::to($user->email)->send(new AlumnosMail($user  ,$case,$request));
        } catch (\Throwable $th) {
            //throw $th;
            return "<h1>Error al envier el mail de actividades, la nota fue cargada con exito de todas formas</h1> <br><br>"
                    .$th->getMessage();
        }
        return redirect()->back()->with($tipo,'success');

    }

    public function desaprobar(Request $request)
    {
      $score = Score::find($request['id_score']);
      $score->nota = 'desaprobado';
      $score->save();
      $TpsEntregados = Tpresuelto::with('scores')->get();
      $user = User::find($request['user_id']);

      $unity = Tp::find( $score->tp_id)->unity()->get();
        if ($unity != []) {
            $unity = $unity[0];
            $course = \App\Unity::find($unity->id)->courses()->get();
            if ($course != []) {
                $course = $course[0];
                $notification = \App\Notification::where([
                                                        ['user_id', $request->user_id],
                                                        ['unity_id',$unity->id],
                                                        ['course_id',$course->id]
                                                        ])->get();
                if (count($notification) == 0) {
                    $notification = new \App\Notification;
                    $notification->user_id = $request->user_id;
                    $notification->tipo = "unidad";
                    $notification->course_id = $course->id;
                    $notification->unity_id = $unity->id;

                }else{
                    $notification = $notification[0];
                    $notification->visto = 0;    
                }
                $notification->save();
            }
        }

      try {
            Mail::to($user->email)->send(new AlumnosMail($user, 'tpDesaprobado'));
        } catch (\Throwable $th) {
            //throw $th;
            return "<h1>Error al envier el mail de actividades, la nota fue cargada con exito de todas formas</h1> <br><br>".$th;
        }

      return redirect()->back()->with('danger', 'danger');
    }

    public function corregirTpFinal(Request $request)
    {

        $user = User::find($request->id);

        if ($request->tpFinal_id != null) {
            $TpFinal = \App\TpFinalResuelto::find($request->tpFinal_id);
            if ($request->resultado == 'aprobado') {
                # code...
                $TpFinal->estado = $request->resultado;
                $TpFinal->save();
            }else {
                $TpFinal->delete();
                return redirect()->back()->with('danger', 'danger');
            }

        }else{
            $TpFinal = new \App\TpFinalResuelto;
            $TpFinal->url = 'sin entregar';
            $TpFinal->tpF_id = $request->TpF_id;
            $TpFinal->user_id = $request->user_id;
            $TpFinal->estado = $request->resultado;
            $TpFinal->save(); 
        }


        return redirect()->back()->with('success','success');

    }

    public function corregirTpVf($tp_id, Request $request)
    {
        $validator = $request->validate([
            'afirmation' => ['required','array']
        ]);
        $tp = \App\TpVf::find($tp_id);
        $aciertos = 0;
        foreach ($tp->afirmations as $af) {
            if ($af->true) {
                if (($request->afirmation[$af->id] ?? null) == 'on') {
                    $aciertos++;
                }
            }else{
                if (($request->afirmation[$af->id] ?? null) == 'off') {
                    $aciertos++;
                }
            }
        }
        $nota = ($aciertos/count($tp->afirmations))*10;

        $score = \App\ScoreTpVf::updateOrCreate(['user_id' => Auth::user()->id , 'tp_id'=>$tp->id],
                                                ['nota' =>$nota]
                                            );
        $data = $request->afirmation;
        return view('alumno.show-tp-vf',['tp'=>$tp,'data' => $data, 'nota' => $nota]);
    }

    public function borrarResuelto(Request $request)
    {
        
        $tpRes = \App\Tpresuelto::find($request->id);
 
        $tpRes->score->delete();
        $tpRes->delete();

        return redirect()->back();
    }

}
