<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

use App\Mail\AlumnosMail;
use App\User;
use App\DatosUser;
use App\Course;
use App\Unity;
use Carbon\Carbon;

class UserController extends Controller
{

    public function index()
    {
      $users = User::all();
      return view('verAlumnos',['users' => $users]);
    }

    public function mostrarAlumno($data, $searchDatosUser)
    {

      if ($searchDatosUser) {
        $datosUser = DatosUser::where('telefono', 'LIKE', '%'.$data.'%')->take(30)->with('user')->get();

        return $datosUser;

      }
      $user = User::where('name','LIKE','%'.$data.'%')
                    ->orWhere('email','LIKE','%'.$data.'%')
                    ->orWhere('id','LIKE','%'.$data.'%')
                    ->take(30)
                    ->with('datosUser')
                    ->get();

      return $user;
    }   

    public function create(Request $request)
    {
      $request->session()->forget('id');
      $user = User::where('id', '>','0')->orderBy('id','DESC')->take(1)->get();
      $request->session()->put('id',$user[0]['id']+1);

      return view('auth.register', ['user' => $user]);
    }

    public function createPostVenta(Request $request)
    {
      $user = User::where('id', '>','0')->orderBy('created_at','DESC')->take(1)->get();
      $request->session()->put('id',$user[0]['id']+1);
      echo "<script>";
        echo "alert('El usuario fue creado con éxito ahora debes completar los datos personales para finalizar el registro');";
      echo "</script>";
      return view('auth.register', ['user' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request, $case = null)
    {

      $id = Auth::user()->id;
      $user = User::find($id);
      $cursos = User::find($id)->courses;
      $notificationCobro = null;
      $country = Auth::user()->datosUser != null ? (Auth::user()->datosUser->country == 'ARG'?'AR':Auth::user()->datosUser->country):null;
      $carrito = false;//control de si aparece el carrito o no

      if ($user->tipo_pago == "efectivo") {
        $hoy = Carbon::now();
        if ($user->infoFac != null) {
          if ($user->infoFac->cobrable) {
            # code...
            $fechaBloqueo = new Carbon($user->infoFac->fecha_sig_cobro);
            $fechaBloqueo->day = $fechaBloqueo->day +5;
            $fechaAviso = new Carbon($user->infoFac->fecha_sig_cobro);
            $fechaAviso->day = $fechaAviso->day - 5;
            if ($hoy > $fechaAviso) {
              $notificationCobro = $fechaBloqueo;
            }
          }
        }
      }

      $visto= true;
      if ($user->tipo_pago != "test") {
        $anuncio = \App\Anuncio::firstOrNew(['user_id' => $id]);
  
        $visto = $anuncio->visto;
        $anuncio->visto = 1;
        $anuncio->save();
      }

      $flagNovedad = true;
      $newNovedad = (object) array('noti' => null, 'cantNoti' => 0);
      $cantNoti = 0;
      foreach ($cursos as $key => $curso) {
        if ($curso->pivot->type == 'test') {
          $carrito = true;
        }
        foreach ($curso->novedades as $key => $novedad) {
          if($novedad->sinVer(Auth::user()->id)){
            $cantNoti++;
            if($flagNovedad){
              $flagNovedad = false;
              $newNovedad->noti = $novedad;
            }
          }
        }
      }
      $newNovedad->cantNoti = $cantNoti;
      if ($flagNovedad) { //OSEA Q YA VIO TODO
        $novedadesAux = \App\Novedad::orderBy('id' , 'DESC')->take(10)->get();
        $index = rand(0,(count($novedadesAux)-1));
        $newNovedad->noti = $novedadesAux[$index];
      }

      if ($case != null) { /**Osea que entra en la version alternativa */

          $i = 0;
          $progreso = array();
          foreach ($cursos as $curso ) {
            $aprobados = 0;
            $cantExamenes = 0;
            $unidades = Course::find($curso->id)->unities()->get();
            foreach ($unidades as $unidad) {
              $exams = Unity::find($unidad->id)->exams()->get();

              foreach ($exams as $exam) {
                $total = 0;
                //$scores = \App\Exam::find($exam['id'])->scoreExams()->get();
                $scores = [];
                $cantExamenes++;
                foreach ($scores as $score ) {
                  if (($score['nota'] == 'aprobado') && ($score['user_id'] == Auth::user()->id)) {
                    $aprobados++;
                  }
                }
              }
            }

            if($cantExamenes == 0 || $cantExamenes == null){
              $curso->progreso = 0;
            }else{
              $aux = 100 / $cantExamenes;
              $curso->progreso = $aux*$aprobados;
              
            }

          }
          return view('user-alt',[
            'user' => $user,
            'cursos' => $user->courses,
          ]);
       
      } 
      /**FUNCION RECURSIVA DE GET RANDDOM VCOURSE
       * EJECUTA HASTA ENCONTRAR UNO Q NO TENGA. sE VA A RE COLGAR CUANDO TENGA TODOS XD
       */
      function getRand($intento){
        $data = \App\Course::inRandomOrder()->first();
        if ($intento > 5) {
          return $data;
        }
        
        foreach (Auth::user()->courses as $k => $cur) {
          if($cur->id == $data->id){
            $cant = $intento; //AGARRO EL NUMERO DE INTENTO
            $data = getRand($cant+1); //LE PASO EL PARAMETRO CON UNA UNIDAD MAS
          }
        }
        return $data;
      }

      $randomCourse = getRand(0);

      
      return view('user.user',[
                          'datosUser' => $user->datosUser,
                          'cursos' => $cursos,
                          'notificationCobro' => $notificationCobro,
                          'anuncio' => $visto,
                          'novedad' => $newNovedad,
                          'country' => $country,
                          'carrito' => $carrito,
                          'randomCourse' => $randomCourse,
                          ]);
    }

    public function getUser($id)
    {
      $user = User::find($id);
      $user->cobros;
      $user->infoFac;
      $user->datosUser;
      $user->adicionales;
      return $user;
    }

    public function getUserMes($mes = null)
    {
        $currentDate = Carbon::now();
        if ($mes == null) {
          $mes = $currentDate->month;
        }
        $users = User::whereMonth('created_at', $mes)->whereYear('created_at', $currentDate->year )->with('courses','infoFac')->get();

        return $users;
    }

    public function update(Request $request, $user_id)
    {
      
        $user = DatosUser::find($user_id);
        $data = User::find($user_id);
        if($data != null){
          
          if($request['name'] != ""){
            $data->name = $request['name'];
            $data->save();
          }

          if($request['email'] != ""){
            $control = User::where('email', $request->email)->get();

            if (count($control) != 0) {
              return view('error.email-existente',['user' => $control[0], 'id' => $data->id]);
            }
            $data->email = $request['email'];
            $data->save();
          }

          if($request['tipo_pago'] != ""){
            $data->tipo_pago = $request['tipo_pago'];
            $data->save();
          }

          
          if($request['password'] != ""){
            $data->password = Hash::make($request['password']);
            $data->save();
          }
        }

        if($user != null ){
            if($request->direccion != ""){
              $user->direccion = $request->direccion;
              $user->save();

            }
            if($request['CP'] != ""){
              $user->CP = $request['CP'];
              $user->save();

            }
            if($request['phone'] != ""){
              $user->telefono = $request['phone'];
              $user->save();
            }
            if($request['dni'] != ""){
              $user->dni = $request['dni'];
              $user->save();
            }
            if($request['city'] != ""){
              $user->ciudad = $request['city'];
              $user->save();
            }
            if($request['province'] != ""){
              $user->provincia = $request['province'];
              $user->save();
            }
            if($request['tarjeta'] != ""){
              
              $user->tarjeta = $request['tarjeta'];
              $user->save();
            }
        }else{
            $user = new DatosUser;
            $user->user_id = $user_id;
            if($request->direccion != ""){
            $user->direccion = $request->direccion;
            $user->save();

            }
            if($request['phone'] != ""){
            $user->telefono = $request['phone'];
            $user->save();
            }
            if($request['dni'] != ""){
            $user->dni = $request['dni'];
            $user->save();
            }
            if($request['city'] != ""){
            $user->ciudad = $request['city'];
            $user->save();
            }
            if($request['province'] != ""){
            $user->provincia = $request['province'];
            $user->save();
            }
            if($request['tarjeta'] != ""){
              $user->tarjeta = $request['tarjeta'];
              $user->save();
            }
        }
        if ($data->infoFac == null) {
          return redirect()->route('Cobranza.formModificarInfoFac',['user_id' => $data->id]);
        }
        return back();
    }


    public function modificarAlumno(Request $request)
    {
      $cursos = Course::all();
      $user = User::find($request['id']);

      //CALCULO LA CANTIDAD DE MESES DESDE Q SE ANOTO
      $hoy = Carbon::now();
      $fecha_ingreso = new Carbon($user->created_at);
      $meses_cursados = $fecha_ingreso->diffInMonths($hoy);

      $avisoPago = \App\AvisoPago::find($request->id);
      if ($avisoPago != null) {
        $avisoPago->visto = 1;
        $avisoPago->save();
      }

      return view('admin.modificarAlumno.index',[
                                                  'user'=> $user,
                                                  'mesesCursados' => $meses_cursados,
                                                  'cursos' => $cursos,
                                                  ]);
      
    }

  public function verNoHabilitados()
  {
    try {
      $users = User::where('habilitado', 0)->orderBy('id','DESC')->take(150)->get();

      return view('admin.panelNoHab', ['users' => $users]);
    } catch (\Throwable $th) {
      return 'Error de bd al abrir el panel de no hab------>   '. $th->getMessage();
    }
  }

  public function modificarHab($id, Request $request)
  {
    
    try {
      $user = User::find($id);

      $historial = \App\HistorialHab::create([
        'user_id'=>$id,
        'admin'=> Auth::id(),
        'case'=> $user->habilitado ? 'deshabilita':'habilita',
      ]);

      if ($user->habilitado == 0) {
        $venta = \App\Venta::where('alumno', $id)->get();
        if (count($venta) != 0) {
          $venta = \App\Venta::find($venta[0]->id);
          $venta->estado = 'cerrada';

         // $venta->puntos_extra = ($request->puntos_extra == null)? $venta->puntos_extra:$request->puntos_extra;
         $venta->comision = $request->comision == null?0:$request->comision;

          $venta->save();
        }
        if ($request->con_kit == "on") {

          $kit = new \App\Kit;
          $kit->user_id = $id;
          $kit->save();

          $user->kit = 1;
          $user->kit_id = $kit->id;
          $user->save();
        }
        if ($request->cant_cuotas != null) {

          $infoFac = \App\InfoFac::find($id);
          
          if ($infoFac == null) {
            $infoFac = new \App\InfoFac;
            $infoFac->user_id = $id;
            $infoFac->cant_cuotas = $request->cant_cuotas;
            $infoFac->monto_cuota = $request->valor_cuota;
            $infoFac->fecha_sig_cobro = Carbon::now();
            
            $infoFac->save();
          }

          if ($request->valor_agregado != 0) {  //Creo el adicional

            $adicional = new \App\Adicional;
            $adicional->user_id = $id;
            $adicional->denominacion = $request->denominacion;
            $adicional->valor = $request->valor_agregado;
            $adicional->cant_cuotas = $request->cant_cuotas_ad;
            $adicional->save();
          }

          if ($request->cargar_cobro == "on") {
            $cobro = new \App\Cobro;
            
            $cobro->user_id = $id;
            $cobro->numero_operacion = 'efectivo';
            $cobro->cuenta_id = 2;

            $monto = $request->valor_cuota;
            if ($request->con_kit == "on") {
              $monto = $request->valor_cuota +1900;
            }
           
            $fecha = Carbon::now();

            $cobro->monto = $monto;
            $cobro->tipo = 0;
            $cobro->cant_cuotas = 1;
            $cobro->fecha = $fecha;
            
            $cobro->save();
            
            
            $fecha->addMonth();

            $infoFac = \App\InfoFac::find($id);

            if ($infoFac->cant_cuotas == 1) {
              $infoFac->cobrable = 0;
            }
            $infoFac->fecha_sig_cobro = $fecha->toDateString();
            $infoFac->save();

          }
        }

      }else{
        $infoFac = \App\InfoFac::find($id);
        
        if ($infoFac != null) {
          $infoFac->cobrable = 0;
          $infoFac->save();
        }
        Mail::to($user->email)->send(new \App\Mail\BloqueoMail($user));
        //ENVIO DE MAIL DE AVISO DE BLOQUEO
      }

      $user->habilitado = !$user->habilitado;

      $user->save();

      foreach ($user->courses as  $course) {
        $course->pivot->type = $user->tipo_pago == null?'total':$user->tipo_pago;
        $course->pivot->save();
      }

      return back();
    } catch (\Throwable $th) {
      //throw $th;
      return "Error al modificar Habilitado ->>>>>>  \n".$th->getMessage();
    }
  }

  public function habilitarUnidad(Request $request)
  {
      $user = User::find($request->id);

      $user->unities_habilitadas = $request->cant;

      $user->save();

      return redirect()->back();
  }

  public function modificarKit(User $User, $kit)
  {

      if ($kit == 1) {
        $newKit = \App\Kit::firstorCreate(['user_id' =>$User->id],['estado' => 'pendiente']);
      }elseif($User->datosKit != null){
        $newKit = \App\Kit::where('user_id', $User->id)->first();
        $newKit->delete();
      }
      $User->kit = $kit;
      $User->save();
      
      return redirect()->back();
  }

  public function sendAlta($id)
  {
    $user = User::find($id);
    try {
      Mail::to($user->email)->queue(new AlumnosMail($user, 'altaEstudiante', null));
      return redirect()->back()->with('alta','success');
    } catch (\Throwable $th) {
      //throw $th;
      return $th->getMessage();
    }
  }

  public function sendDiploma($course_id){
    
    $recibido = \App\Recibido::where([['user_id',Auth::user()->id],['course_id',$course_id]])->first();
    if ($recibido != null) {
      
      $user = \App\User::find(Auth::user()->id);
      $course = \App\Course::find($course_id);
      $course->promedio = $course->promedio(Auth::user()->id); 
      $pdf = \PDF::loadView('pdf.diploma',['user' => $user,'course' => $course])->setPaper('a4', 'landscape');
      return $pdf->stream($user->name.'- Diploma');
    }
    return redirect()->back();
  }

  public function informarPago()
  {
      $informePago = \App\AvisoPago::updateOrCreate(['user_id'=>Auth::user()->id],['visto'=>0]);
      return redirect()->back();
  }

  public function selectCourses()
  {
    $categorias = \App\Categoria::all();

    return view('alumno.select-courses',['categorias'=> $categorias, 'country'=> Auth::user()->datosUser->country]);
  }

}
