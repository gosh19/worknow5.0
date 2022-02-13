<?php

namespace App\Http\Controllers;

use App\Encuesta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EncuestaController extends Controller
{

    public function verificar()
    {
      $id = Auth::id();
      $existe = Encuesta::find($id);
      if ($existe != null) {
        return $existe->voto;
      }
      else {
        return 0;
      }
    }

    public function cargarVoto($case = null, Request $request)
    {
        if ($case == null) {

          Encuesta::create([
            'user_id' => Auth::id(),
            'opcion' => $request->horario,
          ]);
          return redirect()->back();
        }

        Encuesta::create([
          'user_id' => Auth::id(),
          'opcion' => $case,
        ]);
        return redirect()->back();

    }

}
