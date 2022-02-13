<?php

namespace App\Http\Controllers;

use App\Practice;
use Illuminate\Http\Request;

class PracticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $practices = Practice::orderBy('id','desc')->get();

        return view('practice.admin.index', ['practices' => $practices]);
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
            'title' => ['required','string'],
            'desc' => ['required', 'string'],
            'course_id' => ['required'],
        ]);

        $practice = new Practice;

        $practice->titulo = $request->title;
        $practice->desc = $request->desc;
        $practice->course_id = $request->course_id;

        $practice->save();

        return redirect()->back()->with('msj','Practica creada con exito');;

    }

    public function update(Practice $Practice, Request $request)
    {
        $Practice->titulo = $request->title;
        $Practice->desc = $request->desc;

        $Practice->save();

        return redirect()->back()->with('msj','Datos de practica editados con exito');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Practice  $practice
     * @return \Illuminate\Http\Response
     */
    public function edit(Practice $Practice)
    {
        return view('practice.admin.edit-practice', ['practice' => $Practice]);
    }

    public function addStep($practice_id, Request $request)
    {
        $step = new \App\StepPractice;

        $step->practice_id = $practice_id;
        $step->titulo = $request->title;
        $step->numero = $request->numero;
        $step->desc = $request->desc;

        $step->save();

        return redirect()->back();
    }

    public function delete(Practice $Practice)
    {
        $Practice->delete();

        return redirect()
                ->route('Practice.index')
                ->with('msj','Practica eliminada con exito');
    }

    public function editStep(\App\StepPractice $StepPractice, Request $request)
    {
        $StepPractice->titulo = $request->title;
        $StepPractice->desc = $request->desc;
        $StepPractice->numero = $request->numero;

        $StepPractice->save();

        return redirect()->back()->with('msj', 'Paso editado correctamente');
    }

    public function deleteStep(\App\StepPractice $StepPractice)
    {
        $StepPractice->delete();

        return redirect()->back()->with('msj', 'Paso eliminado correctamente');
    }

    public function addImg(Request $request,$practice_id)
    {
        $img = new \App\ResourcePractice;

        $img->practice_id = $practice_id;
        if ($request->has('img')) {
            $file = $request->img;
            $name = $file->store('practice/'.$practice_id, 'public');
            $img->url = '/storage/'. $name;
        }
        $img->save();

        return redirect()->back()->with('msj','Imagen agregada con exito');
    }
    
    public function deleteImg(\App\ResourcePractice $ResourcePractice)
    {
        $ResourcePractice->delete();

        return redirect()->back()->with('msj','Imagen eliminada correctamente');
    }

    public function addImgtoStep(Request $request,$step_id,$practice_id)
    {
        $img = new \App\ResourceStepPractice;

        $img->step_practice_id = $step_id;
        if ($request->has('img')) {
            $file = $request->img;
            $name = $file->store('practice/'.$practice_id.'/step-'.$step_id, 'public');
            $img->url = '/storage/'. $name;
        }
        $img->save();

        return redirect()->back()->with('msj','Imagen agregada con exito');
    }
    
    public function deleteImgStep(\App\ResourceStepPractice $ResourceStepPractice)
    {
        $ResourceStepPractice->delete();

        return redirect()->back()->with('msj','Imagen eliminada correctamente');
    }

    public function showPracticeCourse(\App\Course $Course)
    {
        return view('practice.alumno.index', ['course' => $Course]); 
    }

    public function showPracticeUser(Practice $Practice)
    {
        return view('practice.alumno.show-practice',['practice'=>$Practice]);
    }

    public function showPost()
    {
        
    }
}
