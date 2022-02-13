<?php

namespace App\Http\Controllers;

use App\Cupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CuponController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cupones = Cupon::where('id','>',0)->orderBy('id','DESC')->get();

        return view('cupones.verCupones', ['cupones' => $cupones]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendedoras = \App\Vendedor::getAll();

        return view('cupones.form-crear-cupon',['vendedoras'=> $vendedoras]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cupon = new Cupon;

        $cupon->name = $request->name;
        $cupon->monto = $request->monto;
        $cupon->url = $request->url;
        $cupon->vendedor = $request->vendedor;

        $cupon->save();

        return redirect('/Cupon/create')->with('msg', 'Cupon creado con exito');
    }

    /**
     * recibe el id de cupón y modifica el habilitado por el contrario al q tiene
     */
    public function modificarHab($id)
    {
        $cupon = Cupon::find($id);

        $cupon->habilitado = !$cupon->habilitado;

        $cupon->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function show(Cupon $cupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Cupon $Cupon)
    {   
        //$cupon = json_decode($cupon, true);
        $vendedoras = \App\Vendedor::getAll();
        return view('cupones.form-edit-cupon', ['cupon' => $Cupon, 'vendedoras' => $vendedoras]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $cupon = Cupon::find($request->id);

            $cupon->name = $request->name;
            $cupon->monto = $request->monto;
            $cupon->url = $request->url;
            $cupon->vendedor = $request->vendedor;

            $cupon->save();

            return redirect()->route('Cupon.index')->with('msg', 'update');
        }
        catch (\Throwable $th){
            return "Error al modificar contactese con el administrador------------>>". $th;
        }

        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cupon = Cupon::destroy($id);

            return redirect()->route('Cupon.index')->with('msg', 'delete');

        } catch (\Throwable $th) {
            //throw $th;
            return "Error al Borrar contactese con el administrador------------>>". $th;
        }
        return 0;
    }
}
