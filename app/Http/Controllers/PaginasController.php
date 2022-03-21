<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use App\Mail\AlumnosMail;

use App\User;
use App\DatosUser;


class PaginasController extends Controller
{
    public function index()
    {
      return view('admin');
    }

    public function ingresoAlternativo()
    {
      return view('auth.login');
    }

    public function preIntro()
    {
      if (session('country')) {
        //return session('country');
        return redirect()->route('intro',['country'=>session('country')]);
      }

      return view('preIntro.index');
    }

    public function intro($country = null)
    {
      //return $country;
      if (Auth::check()) {
        return redirect('/User/'.Auth::id());
      }
      $courses = \App\Course::all();
      $categorias = \App\Categoria::orderBy('order','asc')->get();
      //\App\User::getDataIp();

      session()->forget('country');
      session(['country'=> $country]);



      $users = \App\User::take(1000)
                              ->orderBy('id','DESC')
                              ->get();
      $masElegidos = [];
      foreach ($users as $user) {
        foreach ($user->courses as $course) {
          if (!\Illuminate\Support\Arr::exists($masElegidos,$course->nombre)) {
            $masElegidos[$course->nombre] = ['id'=>$course->id,'nombre'=>$course->nombre, 'cant'=> 1,'img'=>$course->url_img];
          }else{
            $masElegidos[$course->nombre]['cant']++;
          }
        }
      }
      usort($masElegidos, function ($a, $b) { return ($a['cant'] <= $b['cant']); });

      session()->forget('country');
      session(['country'=>$country]);
      //return session('country');
      /**cambiamo0ps a la vista inicio q es el nuevo maquetado */
      return view('intro.inicio',['courses'=> $courses, 'categorias'=> $categorias,'country'=>$country, 'masElegidos'=> $masElegidos]);
    }
    public function coursesView()
    {
      $categorias = \App\Categoria::orderBy('order','asc')->get();
      
      return view('intro.courses-view',['categorias'=> $categorias]);
    }
    
    public function addCourse(\App\Course $Course)
    {
      if (!session()->has('selected.0')) {
        session()->put('selected.0', $Course);
      }else if (!session()->has('selected.1')) {
          session()->put('selected.1', $Course);
      }else if (!session()->has('selected.2')) {
          session()->put('selected.2', $Course);
      }

      return redirect('/inscripcion');
    }

    public function inscripcionTemprana(Request $request)
    {
      $request->session()->forget('id');
      $user = User::where('id', '>','0')->orderBy('id','DESC')->take(1)->get();
      $request->session()->put('id',$user[0]['id']+1);
      \App\User::getDataIp();

      $request->session()->forget('email');
      $request->session()->forget('password');
      $request->session()->put('email',$request->email);
      $request->session()->put('password',$request->password);

      return view('intro.register', ['user' => $user, 'country'=> session('country')]);
    }

    public function showCourse(\App\Course $Course, $origin=null)
    {
        if ($origin != null) {
          session()->put('platform',$origin);
        }
       $courses = \App\Course::where('nombre','LIKE','%celulares%')
                            ->orWhere('nombre','LIKE','%seco%')
                            ->orWhere('nombre','LIKE','%electrod%')
                            ->orWhere('nombre','LIKE','%pc%')
                            ->get();
      \App\User::getDataIp();

      $canSelect = true;
      if (session()->has('selected')) {
        foreach (session('selected') as $selected) {
          if($selected->id == $Course->id){
            $canSelect = false;
            break;
          }
        }
      }

      return view('intro.show-course',['course' => $Course,'country'=>session('country'), 'canSelect'=>$canSelect, 'list'=>$courses]);
    }


    public function cargarUser(Request $request)
    {
      if ($request['curso'] != []) {
        $user = new User;
        $user->id = $request['id'];
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->rol = $request['rol'];
        $user->tipo_pago = 'test';
        $user->save();

        DatosUser::create([
          'user_id' => $request['id'],
          'dni' => $request['dni'],
          'direccion' => '-',
          'telefono' => $request['telefono'],
          'ciudad' => $request['ciudad'],
          'provincia' => $request['provincia'],
          'tarjeta' => 'test'
        ]);

        session()->put('id',$request['id']);

        session()->put('log', 1);

        $user = User::find($request['id']);

        foreach ($request['curso'] as $curso_id) {
          $user->courses()->attach($curso_id);
        }
        
        //CREO EL USER TEST 
        $userTest = new \App\UserTest;
        $userTest->user_id = $request['id'];
        $userTest->save();

        //Envio el alta
        Mail::to($user->email)->queue(new AlumnosMail($user, 'altaEstudiante'));

        return redirect()->route('login',['id'=> $request->id])->with('mensaje','Ahora solo debes ingresar tus datos para ingresar al curso');
      }
      else{
        return redirect()->back()->with('error', 'Debe Seleccionar un curso al menos');
      }

    }
}
