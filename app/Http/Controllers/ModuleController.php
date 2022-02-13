<?php

namespace App\Http\Controllers;

use App\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModuleController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        //
    }

    public function update(Request $request, Module $Module)
    {
        $Module->titulo = $request->titulo;
        $Module->save();

        return redirect()->back();
    }

    public function delete(Request $request)
    {
      $module = Module::find($request['module_id']);
      
      $module->delete();
      return redirect()->back();
    }

    public function add(Request $request)
    {
      if($request->hasFile('modulo')){
        $file = $request->file('modulo');
        $name = $file->store('modulos', 'public');
        $name = '/storage/'.$name;
        $module = new Module;
        $module->titulo = $request['nombre'];
        $module->url = $name;
        $module->unity_id = $request['unity_id'];
        $module->save();
      }
      return redirect()->back();
    }


}
