<?php
namespace App\Http\Controllers;

use App\Unity;
use App\Tp;
use App\Exam;
use App\Course;
use App\Module;
use App\User;
use App\VideosYT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UnityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $cursosUser = User::find(Auth::user()->id)->courses()->get();
      $unity = Unity::find($request['id']);

      $control = false;
      foreach ($cursosUser as $key => $curso) {
        foreach ($unity->courses as $i => $cur) {
          if ($cur->id == $curso->id)  {
            $control = true;
            break 2;
          }
        }
      }
      
      if(((Auth::user()->habilitado) && $control) || (Auth::user()->rol == 'admin')|| (Auth::user()->rol == 'desarrollo')){

          $notifications = \App\Notification::where([
                                                    ['user_id',Auth::user()->id],
                                                    ['tipo','unidad'],
                                                    ['unity_id',$unity->id],
                                                    ['visto', 0],
                                                    ])->get();
                                                    
          foreach ($notifications as $notification) {
            $notification->visto = 1;
            $notification->save();
          }

          return view('course.show-unity', ['unity' => $unity]);
       
        }
        return view('error.acceso-restringido');

    }

    public function showUser(\App\Unity $unity)
    {
      $control = false;
      if (Auth::user()->rol == 'alumno') {
        # code...
        $cursosUser = Auth::user()->courses;
        
        foreach ($cursosUser as $key => $curso) {
          foreach ($unity->courses as $i => $cur) {
            if ($cur->id == $curso->id)  {
              $course = $curso;
              $control = true;
              break 2;
            }
          }
        }
      }else{
        $course = $unity->courses[0];

      }

      
      if(((Auth::user()->habilitado) && $control) || (Auth::user()->rol == 'admin')|| (Auth::user()->rol == 'desarrollo')){

          $notifications = \App\Notification::where([
                                                    ['user_id',Auth::user()->id],
                                                    ['tipo','unidad'],
                                                    ['unity_id',$unity->id],
                                                    ['visto', 0],
                                                    ])->get();
                                                    
          foreach ($notifications as $notification) {
            $notification->visto = 1;
            $notification->save();
          }
          return view('course.show-unity', ['unity' => $unity,'course'=>$course]);
       
        }
        return view('error.acceso-restringido');
    }

    /**
     * MUESTRA TODAS LAS UNIDADES
     */
    public function verUnidades()
    {
      $unidades = Course::with('unities')->get();
      return view('verUnidades',['unidades'=>$unidades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crearCurso.crearUnidad');
    }

    /**
     * Store a newly created resource in storage.
     * CARGA UNIDAD, RELACION UNIDAD/CURSO(S) Y MODULO CON RELACION UNIDAD/MODULO
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //GUARDO LA UNIDAD

        $unity = new Unity;
        $unity->nombre = $request['name'];
        $unity->descripcion = $request['descripcion'];
        $unity->cant_tp = 0;
        $unity->cant_ev = 0;
        $unity->cant_modulos = 0;
        $unity->save();
        //AGARRO EL ULTIMO REGISTRO PARA OBTENER EL ID DE LA UNIDAD CARGADA
        $unityID = Unity::where('id','>','0')->orderBy('id', 'DESC')->take(1)->get();
        //AGARRO EL ARRAY DE ARCHIVOS Y LOS SUBO A LA CARPETA
        //STORAGE/APP/MODULOS
        //Y CREA LA RELACION MODULO/Unidad
        //SUMA LA CANTIDAD DE MODULOS
          $cant_modulos =0;
          foreach ( $request->modulos as $modulo) {
            $file = $modulo;


            $name = $file->store('modulos', 'public');
            $name = '/storage/'.$name;

            $modulo = new Module;
            $modulo->titulo = $request['titulomodulos'][$cant_modulos];
            $modulo->url = $name;
            $modulo->unity_id = $unityID[0]['id'];
            $modulo->save();

            $cant_modulos++;
          }
          //GUARDO LOS TPS EN LA CARPETA STORAGE/APP/Tps
          //GUARDO LOS DATOS EN LA BD
          $cant_tps=0;
          foreach ( $request->tps as $tp) {
            $cant_tps++;
            $file = $tp;

            $name = $file->store('tps', 'public');
            $name = '/storage/'.$name;


            $tp = new Tp;
            $tp->numero = $cant_tps;
            $tp->url = $name;
            $tp->unity_id = $unityID[0]['id'];
            $tp->save();
          }
          $unity->cant_tp = $cant_tps;
          $unity->cant_modulos = $cant_modulos;
          $unity->save();
        //SUMO UNA UNIDAD AL/LOS CURSO/S AL Q LE ASIGNE LA UNIDAD
        //GENERO LA RELACION UNIDAD/CURSO
        foreach ($request['curso'] as $curso) {
          $cur = Course::find($curso);
          $cur->cant_unidades++;
          $cur->valor = (1/$cur->cant_unidades)*100;
          $cur->save();
          $cur->unities()->attach($unityID[0]['id']);
        }
        if ($request['boton'] == "Crear otra unidad") {
          return redirect()->route('Unidad.create');
        }
        else if ($request['boton'] == "Terminar") {
          return redirect()->back()->with('alert', 'success');
        }
    }

    /**
     * MUESTRA EL PANEL DE EDICION DE UNA UNIDAD
     */
     public function addTP(Request $request)
     {

       if($request->hasFile('tp')){

         $file = $request->file('tp');
         $name = $file->store('tps', 'public');
         $name = '/storage/'.$name;
         $tp = new Tp;
         $tp->numero = $request['tpNum'];
         $tp->url = $name;
         $tp->unity_id = $request['unity_id'];
         $tp->save();
       }
       return redirect()->back();
     }

    public function verEditar(Request $request)
    {
      $unidad = Unity::find($request->id);

      return view('crearCurso.editarUnidad', [
                                              'unidad' => $unidad, 
                                            ]);
    }

    public function delete(Unity $Unity)
    {

      foreach ($Unity->modules as $module) {
        $module->delete();
      }
      foreach ($Unity->tps as $tp) {
        foreach ($tp->Tpresueltos as $tpRes) {
          if ($tpRes->score != null) {
            $tpRes->score->delete();
          }
          $tpRes->delete();
        }
        $tp->delete();
      }
      foreach ($Unity->exams as $exam) {
        foreach ($exam->questions as $question) {
          $question->delete();
        }
        foreach ($exam->scores as $score) {
          $score->delete();
        }
        $exam->delete();
      }
      foreach ($Unity->videos as $video) {
        $video->delete();
      }
      $Unity->courses()->detach();
      $Unity->delete();

      return redirect('/verUnidades');
    }
    /**
     * UPDATEA LOS DATOS
     */
    public function editar(Request $request, $id)
    {
      $unidad = Unity::find($id);

      $unidad->nombre = $request['nombre'];
      $unidad->descripcion = $request['descripcion'];

      $unidad->save();

      return redirect()->back()->with('success','Unidad editada con exito');
    }

    public function addTpFinal(Request $request)
    {
      

      if($request->hasFile('tpFinal')){
        try {
          $file = $request->file('tpFinal');
          $name = $file->store('tpsFinals', 'public');
          $name = '/storage/'.$name;
          $tpFinal = new \App\TpFinal;
          $tpFinal->url = $name;
          $tpFinal->unity_id = $request['unity_id'];
          $tpFinal->save();

          return redirect()->back();
        } catch (\Throwable $th) {
          return $th;
        }
        
      }
      
    }

    public function deleteTpFinal($id)
    {
      $tpFinal = \App\TpFinal::find($id);

      $tpFinal->delete();

      return redirect()->back();
    }

}
