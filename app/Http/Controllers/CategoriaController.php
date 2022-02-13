<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function setCatCourse(Request $request)
    {
        foreach ($request->categoria as  $cat) {
            if ($cat != null) {
                # code...
                $categoria = Categoria::find($cat);
                foreach ($request->course as  $cour) {
                    if ($cour != null) {
                        $categoria->courses()->detach($cour);
                        $categoria->courses()->attach($cour);
                        echo 'echo';
                    }
                }
            }
        }
        return redirect()->back();
    }

    public function setOrder(Categoria $categoria, Request $request)
    {
        $categoria->order = $request->order;
        $categoria->save();

        return redirect()->back();
    }

    public function deleteCatCourse(Categoria $categoria, $course)
    {
        $categoria->courses()->detach($course);

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => ['required'],
        ]);
        $categoria = new Categoria;

        $categoria->name = $request->name;

        $categoria->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $Categorium)
    {
        return view('tienda.admin.show-categoria',['categoria'=> $Categorium]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function delete(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->back();
    }
}
