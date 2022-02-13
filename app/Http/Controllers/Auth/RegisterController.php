<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\DatosUser;
use App\Course;
use App\Venta;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;

use App\Mail\AlumnosMail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::CREATE_DATOSUSER;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('rol');
    }


    protected function register(Request $data)
    {
      if (Auth::user()->rol == 'admin') {
        $control = User::where('email', $data->email)->get();
        
        if (count($control) != 0) {
          return view('error.email-existente',['user' => $control[0], 'id' => $data->id]);
        }
      }
      $validator = $data->validate([
        'id' => ['required', 'integer', 'unique:users'],
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6', 'confirmed'],
        'rol' => ['required', 'string', 'max:255'],
        'curso' => ['required', 'array'],
      ]);
      
      $user = new User;
      $user->id = $data['id'];
      $user->name = $data['name'];
      $user->email = $data['email'];
      $user->password = Hash::make($data['password']);
      $user->rol = $data['rol'];

      //CONTROLO SI ES ADMIN O VENDEDOR QUIEN CARGA EL USER PARA LA HABILITACION 
      if(Auth::user()->rol == "admin"){

        $habilitado = 1;

        $user->habilitado = $habilitado;
        $user->save();
      }else{
        $habilitado = 0;

        $user->habilitado = $habilitado;
        $user->save();
        $venta = new Venta;

        $fechaHoy = \Carbon\Carbon::now();

        $venta->fecha = $fechaHoy;
        $venta->vendedor = Auth::user()->id;
        $venta->alumno = $data['id'];
        $venta->estado = 'pendiente';   //CARGO LA VENTA INICIALMENTE COMO PENDIENTE

        $venta->save();

      }
      session()->put('id',$data['id']);

      $user = User::find($data['id']);

      foreach ($data['curso'] as $curso_id) {
        $user->courses()->attach($curso_id);
      }

      try {
        Mail::to($user->email)->queue(new AlumnosMail($user, 'altaEstudiante'));
      } catch (\Throwable $th) {
        //throw $th;
        return "error al enviar el correo <h2>SACA UNA CAPTURA PARA EVALUAR EL ERROR Y PRESIONE </h2>
        <a href='/' style='font-size: 22px;display: block; background: orange;width: 12%;color:black;text-decoration: none; padding: 10px;border-radius: 7px;margin-left: auto; margin-right: auto;'>AQUI</a>
        <h2>PARA SALIR </h2>
        <h1><strong>EL ALUMNO YA FUE CARGADO Y PUEDE INGRESAR</strong></h1>
        ------>  ".$th->getMessage();
      }


      return redirect('/DatosUser/create');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        if (Auth::user()->rol == 'admin') {
            $control = User::where('email', $data->email)->get();
            
            if (count($control) != 0) {
              return view('error.email-existente',['user' => $control[0], 'id' => $data->id]);
            }
          }

        $user = new User;
        $user->id = $data['id'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->rol = $data['rol'];

        //CONTROLO SI ES ADMIN O VENDEDOR QUIEN CARGA EL USER PARA LA HABILITACION 
        if(Auth::user()->rol == "admin"){

            $habilitado = 1;

            $user->habilitado = $habilitado;
            $user->save();
        }else{
            $habilitado = 0;

            $user->habilitado = $habilitado;
            $user->save();
            $venta = new Venta;

            $fechaHoy = \Carbon\Carbon::now();

            $venta->fecha = $fechaHoy;
            $venta->vendedor = Auth::user()->id;
            $venta->alumno = $data['id'];
            $venta->estado = 'pendiente';   //CARGO LA VENTA INICIALMENTE COMO PENDIENTE

            $venta->save();

        }
        session()->put('id',$data['id']);

        $user = User::find($data['id']);

        foreach ($data['curso'] as $curso_id) {
            $user->courses()->attach($curso_id);
        }

        try {
            Mail::to($user->email)->queue(new AlumnosMail($user, 'altaEstudiante'));
        } catch (\Throwable $th) {
            //throw $th;
            return "error al enviar el correo <h2>SACA UNA CAPTURA PARA EVALUAR EL ERROR Y PRESIONE </h2>
            <a href='/' style='font-size: 22px;display: block; background: orange;width: 12%;color:black;text-decoration: none; padding: 10px;border-radius: 7px;margin-left: auto; margin-right: auto;'>AQUI</a>
            <h2>PARA SALIR </h2>
            <h1><strong>EL ALUMNO YA FUE CARGADO Y PUEDE INGRESAR</strong></h1>
            ------>  ".$th->getMessage();
        }


        return redirect('/DatosUser/create');
        
    }
        
}
