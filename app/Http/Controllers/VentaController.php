<?php

namespace App\Http\Controllers;

use App\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $ventas = Venta::where('vendedor', Auth::user()->id)->get();
            return view('vendedor.verVentas', ['ventas' => $ventas]);
        } catch (\Throwable $th) {
            return 'ERROR --->  '.$th;
        }
    }

    public function modificarAlta(Request $request)
    {
        $venta = Venta::where('alumno', $request->id)->get();

        $venta[0]->alta = !$venta[0]->alta;

        $venta[0]->save();

        return redirect()->back();
    }

    public function modificarEstado(Request $request)
    {
        $venta = Venta::find($request->id);

        $venta->estado = $request->estado;
        $venta->fecha = $request->date;
        $venta->puntos_extra = $request->puntos_extra;
        $venta->comision = $request->comision;

        $venta->save();

        return redirect()->back();
    }
}
