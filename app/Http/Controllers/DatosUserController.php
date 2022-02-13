<?php

namespace App\Http\Controllers;

use App\DatosUser;
use App\User;
use App\Estado;
use App\Cobro;
use App\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatosUserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('register.crear_datosUser',['id' => session('id')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user = User::find($request['id']);
      $user->tipo_pago = $request['tipo_pago'];
      $user->habilitado = ($request->tipo_pago == 'test') ? 1:0;
      $user->kit = $request->kit == null ? 0:1;
      $user->save();

      if ($request->kit != null) {
            
        $userKit = \App\Kit::firstOrNew(
                                            ['user_id'=> $user->id]
                                        );
        $userKit->kit_type_id = $request->kit;
        $userKit->save();
      }

      $datosUser = new DatosUser;
      $datosUser->user_id = $request['id'];
      $datosUser->dni = $request['dni'];
      $datosUser->direccion = $request['direccion'];
      $datosUser->telefono = $request['telefono'];
      $datosUser->ciudad = $request['ciudad'];
      $datosUser->provincia = $request['provincia'];
      $datosUser->CP = $request->CP;
      $datosUser->tarjeta = $request['tarjeta'];
      $datosUser->country = $request->country;


      $datosUser->save();

      return  redirect('/');
    }


    /**
     * REVISAR PORQ ESTA GUARDANDO COMO EL REVERENDO CULO
     */
    public function editar(Request $request)
    {
        $datosUser = DatosUser::where('user_id', $request->id)->get();
        
        
        if (count($datosUser) == 0) {
            $datosUser = new DatosUser;
        }
        else{
            $datosUser = DatosUser::find($request->id);
        }
        
        $datosUser->user_id = $request->id;
        $datosUser->dni = $request->dni;
        $datosUser->direccion = $request->direccion;
        $datosUser->telefono = $request->telefono;
        $datosUser->ciudad = $request->ciudad;
        $datosUser->provincia = $request->provincia;
        $datosUser->CP = $request->CP;
        $datosUser->tarjeta = $request->tarjeta;
        $datosUser->country = $request->country;
        

        if (Auth::user()->rol != 'admin') {
            $venta = Venta::where('alumno', $request->id)->get();
            //SI NO ESTA CREADA LA VENTA LA CREO
            if ($venta == []) {
                $venta = new Venta;

                $venta->vendedor = Auth::user()->id;
                $venta->alumno = $request->id;

            }
            //SINO LA MODIFICO
            else{
                $venta = Venta::find($venta[0]->id);
            }

            $venta->save();
        }

        $datosUser->save();

        $user = User::find($request->id);

        $user->tipo_pago = $request->tipo_pago;
        
        $user->kit = $request->kit == null ? 0:1;
        if ($request->kit != null) {
            
            $userKit = \App\Kit::firstOrNew(
                                                ['user_id'=> $user->id]
                                            );
            $userKit->kit_type_id = $request->kit;
            $userKit->save();
        }

        $user->habilitado = ($request->tipo_pago == 'test') ? 1:0;
        $user->save();

        return redirect('/');
    }

    public function changeCountry($user_id, Request $request)
    {
        $datosUser = DatosUser::find($user_id);

        $datosUser->country = $request->country;

        $datosUser->save();
        
        return redirect()->back();
    }
}
