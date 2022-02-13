<?php

namespace App\Http\Controllers;

use App\Course;
use App\Unity;
use App\Score;
use App\Tp;
use App\User;
use App\CourseUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cursos = Course::all();
        return view('listaCursos', ['cursos' => $cursos]);
    }

    public function create()
    {
        return view('crearCurso.crearCurso');
    }

    public function editar(\App\Course $course, Request $request)
    {
      $course->descripcion = $request->descripcion;
      $course->save();

      return redirect()->back();
    }

    public function verCursos()
    {
        $cursos = Course::all();
        return view('desarrollo.verCursosDesarrollo', ['cursos' => $cursos]);

    }

    public function getAllCursos()
    {
      try {
        //code...
        $cursos = Course::all();
        return $cursos;
      } catch (\Throwable $th) {
        return $th;
      }
      
    }
    
    public function getCursos()
    {
        $scores = \App\Score::where([
                                    ['user_id', Auth::user()->id],
                                    ['nota', 'aprobado'],
                                    ])->get();

        $cursos = User::find(Auth::user()->id)->courses()->get();
    
        foreach ($cursos as $curso) {
          $auxAcumulado = 0;
          
          $notifications = \App\Notification::where([
                                                    ['user_id',Auth::user()->id],
                                                    ['tipo','unidad'],
                                                    ['course_id',$curso->id],
                                                    ['visto', 0],
                                                    ])->get();
          $curso->notification = count($notifications);


          $curso->promedio = $curso->promedio(Auth::user()->id);

          $curso->diploma = null;
          if ($curso->recibido(Auth::user()->id) != null) {
            $aux = $curso->recibido(Auth::user()->id);
            $curso->diploma = $curso->recibido(Auth::user()->id);
            $aux->visto = 1;
            $aux->save();
          }
        }

        return $cursos;
    }
    /**
     * Store a newly created resource in storage.
     * CARGA EL CURSO Y REDIRIGE A CREAR UNIDAD
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request['imagen'];
        $nameimg = $file->store('imagenes_cursos','public');
        $nameimg = '/storage/'.$nameimg;

        $file = $request['temario'];
        $nameTemario = $file->store('temarios','public');
        $nameTemario = '/storage/'.$nameTemario;

        Course::create([
          'nombre' => $request['name'],
          'descripcion' => $request['descripcion'],
          'url_img' => $nameimg,
          'url_temario' => $nameTemario,
        ]);



        return redirect()->route('Unidad.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
      if (Auth::user()->habilitado) {
     
      $cursosUser = Auth::user()->courses;
      foreach ($cursosUser as $curso ) {
        if (($curso->id == $id) || (Auth::user()->rol == 'admin') || (Auth::user()->rol == 'desarrollo')) {
          if (Auth::user()->rol == 'admin') {
            # code...
            $curso = Course::find($id);//ESTO HAY Q ARREGLARLO VIEJA ESTA RE RANCIO
          }

          $cursos = Course::find($id)->users;
          $tps = Unity::with('tps')->get();
          $notas = Tp::with('scores')->get();

          $scores = \App\Score::where([
                                      ['user_id', Auth::user()->id],
                                      ['nota', 'aprobado'],
                                      ])->get();
                              
          $colores = array("rojo", "azul", "amarillo", "verde", "negro", "blanco");

          //$tpsAprobados = Score::where('user_id', '=', Auth::user()->id)->where('nota', '=', 'aprobado')->where('tipo', '=', 'tp')->tps()->get();
          $entregados = Tp::with('scores')->get();
          $tip = null;
          if (count( $curso->tips) != 0) {
            $index = rand(0, (count( $curso->tips)-1));
            $tip = $curso->tips[$index];
          }

          foreach ($curso->unities as $unity) {
            $auxAcumulado =0;
            $cantAprobados = 0;
            $notifications = \App\Notification::where([
                                                      ['user_id',Auth::user()->id],
                                                      ['tipo','unidad'],
                                                      ['unity_id',$unity->id],
                                                      ['visto', 0],
                                                      ])->get();
            $unity->notification = count($notifications);
            foreach ($unity->tps as $tp ) {
              foreach ($scores as $score ) {
                if ($tp->id == $score->tp_id) {
                  $auxAcumulado = $auxAcumulado + $score->nota_numerica;
                  $cantAprobados++;
                }
              }
            }
            foreach ($unity->tpsVf as $key => $value) {
              if ($value->score != null) {
                # code...
                if ($value->score->nota > 7) {
                  $auxAcumulado = $auxAcumulado + $value->score->nota;
                  $cantAprobados++;
                }
              }
            } 

            if($cantAprobados == 0){
              $cantAprobados = 1;
            }
            $unity->promedio = round(($auxAcumulado/$cantAprobados),2);
          }

          return view('course.index', [
            'curso' => $curso,
            'tps' => $tps,
            'entregados' => $entregados,
            'cursos' => $cursos,
            'notas' => $notas,
            'tip' =>$tip,
            ]);
        }
      }
    }
    return view('error.acceso-restringido');

    }

    public function showAdmin($id)
    {

      return $this->show($id);
    }

    public function showPostVenta(Request $request)
    {
      $id = $request['id'];
      return $this->show($id);
    }

     public function confirmar_delete(Request $request)
     {
       $curso = Course::find($request['id']);
       return view('confirmar_delete', ['curso' => $curso]);
     }

    public function destroy(Request $request)
    {
        $curso = Course::find($request['id']);
        $curso->unities()->detach();
        $curso->users()->detach();
        foreach ($curso->pendientes as $key => $value) {
          $value->delete();
        }
        
        $curso->delete();
        return redirect('/Cursos');
    }

    public function agregarAlumno(Request $request)
    {
        $user = User::find($request['user_id']);
        $course = Course::find($request['course_id']);
        $user->courses()->attach($request['course_id']);
        /*
        try {
          Mail::to($user->email)->send(new \App\Mail\NewCourseMail($user,$course));
        } catch (\Throwable $th) {
          throw $th;
        }**/
        return redirect()->back()->with('alerta', 'success');
    }

    public function baja(Request $request)
    {
        $user = User::find($request['user_id']);
        $user->courses()->detach($request['course_id']);
        return redirect()->back();
    }

    public function setType(\App\Course $course,$user_id,Request $request)
    {

      $data = \Illuminate\Support\Facades\DB::table('course_user')
                                            ->where([['course_id',$course->id],['user_id',$user_id]])
                                            ->update(['type' => $request->type,'unities'=> $request->unities]);

      return redirect()->back();
    }

    public function setVideoMuestra($id, Request $request)
    {
      $video = \App\VideoMuestra::updateOrCreate(['course_id'=> $id],['url'=>$request->url]);

      $video->save();

      return redirect()->back();
    }
}
