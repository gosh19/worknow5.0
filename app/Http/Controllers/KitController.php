<?php

namespace App\Http\Controllers;

use App\Kit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class KitController extends Controller
{
    public function confirmData($id)
    {
        try {
            $kit = Kit::find($id);

            if ($kit->user_id != Auth::user()->id) {
                return ['estado' => 0];
            }
            $kit->confirmed = 1;
            $kit->save();

            return ['estado' => 1];
        } catch (\Throwable $th) {
            return ['estado' => 0,'error'=> $th->getMessage()];
        }
        
    }

    public function getInfo()
    {
        $estado = 0;
        try {
            $kit = Kit::where([['user_id',Auth::user()->id],['estado','!=','recibido']])->with('user')->get();
            if (count($kit) != 0) {
                $kit = $kit[0];
                $estado = 1;
            }
            return ['estado' => $estado, 'kit' => $kit];
        } catch (\Throwable $th) {
            return ['estado' => $estado, 'error' => $th->getMessage()];
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kit = Kit::where('user_id', $request->user_id)->get();

        if (count($kit) == 0) {
            $kit = new Kit;
            $kit->user_id = $request->user_id;
        }else{

            $kit = $kit[0];
        }
        
        $kit->estado = $request->estado;
        $kit->codigo_seguimiento = $request->codigo_seguimiento;
        $kit->kit_type_id = $request->kit;
        $kit->comentario = $request->comentario;

        $kit->save();

        if ($request->back != null) {
            return redirect()->back()->with('msg','Cargado con exito');
        }

        return redirect()->route('User.modificarAlumno', ['id' => $request->user_id])->with('kit-aprobado', 'success');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \App\User::find($id);

        return view('kit.form-kit', ['user' => $user]);
        
    }

    public function kitReceived($id)
    {
        $kit = Kit::find($id);

        $kit->estado = 'recibido';

        $kit->save();

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kit $kit)
    {
        return $request;
    }

    public function showKits()
    {
        $kitsPendientes = Kit::where('estado','pendiente')->orderBy('updated_at','desc')->get();
        $kitsGen = Kit::where('estado', '!=', 'pendiente')->orderBy('updated_at','desc')->get();

        $kitTypes = \App\KitType::all();

        return view('kit.show-all',[
                                    'kitsPend' => $kitsPendientes, 
                                    'kitsGen' => $kitsGen,
                                    'kitTypes' => $kitTypes,
                                    ]);
    }

}
