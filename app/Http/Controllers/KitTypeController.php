<?php

namespace App\Http\Controllers;

use App\KitType;
use Illuminate\Http\Request;

class KitTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kit = new \App\KitType;

        $kit->name = $request->name;
        $kit->precio = $request->precio;
        $kit->puntos = $request->puntos;

        $kit->save();

        return redirect()->back()->with('msg','Cargado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KitType  $kitType
     * @return \Illuminate\Http\Response
     */
    public function show(KitType $kitType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KitType  $kitType
     * @return \Illuminate\Http\Response
     */
    public function edit(KitType $kitType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KitType  $kitType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KitType $KitType)
    {
        $KitType->name = $request->name;
        $KitType->precio = $request->precio;
        $KitType->puntos = $request->puntos;

        $KitType->save();

        return redirect()->back()->with('msg','Modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KitType  $kitType
     * @return \Illuminate\Http\Response
     */
    public function destroy(KitType $KitType)
    {
        $KitType->delete();
        return redirect()->back();
    }
}
