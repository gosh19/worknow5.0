<?php

namespace App\Http\Controllers;

use App\Problem;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $problems = Problem::all();

        return view('problem.index',['problems' => $problems]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('problem.form-create');
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
            'sintoma' => ['required'],
            'course_id' => ['required'],
        ]);
        $problem = new Problem;

        $problem->sintoma = $request->sintoma;
        $problem->descripcion = $request->descripcion;
        $problem->course_id = $request->course_id;

        if ($request->has('imagen')) {
            $file = $request->imagen;
            $name = $file->store('img_steps', 'public');
            $problem->img = '/storage/'. $name;
        }


        $problem->save();

        return redirect()->route('Problem.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function show(Problem $Problem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function edit(Problem $Problem)
    {
        return view('problem.form-create',['problem' => $Problem]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $problem = Problem::find($id);

        $problem->sintoma = $request->sintoma;
        $problem->descripcion = $request->descripcion;
        $problem->course_id = $request->course_id;

        if ($request->has('imagen')) {
            $file = $request->imagen;
            $name = $file->store('img_steps', 'public');
            $problem->img = '/storage/'. $name;
        }

        $problem->save();

        return redirect()->route('Problem.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $problem = Problem::find($id);

        $problem->delete();

        return redirect()->back();
    }

    public function showSteps(Problem $Problem)
    {
        return view('problem.addSteps',['problem' => $Problem]);
    }

    public function addStep(Problem $Problem, Request $request)
    {
        $validator = $request->validate([
            'descripcion' => ['required'],
            'numero' => ['required', 'integer']
        ]);

        $step = new \App\Step;
        $step->problem_id = $Problem->id;
        $step->descripcion = $request->descripcion;
        $step->numero = $request->numero;
        $step->save();

        return redirect()->back();
    }

    public function destroyStep(\App\Step $Step)
    {
        $Step->delete();

        return redirect()->back();
    }

    public function showSteptoEdit(\App\Step $Step)
    {
        return view('problem.showSteptoEdit',['step' => $Step]);
    }
    public function editStep(\App\Step $Step, Request $request)
    {
        $Step->descripcion = $request->descripcion;
        $Step->numero = $request->numero;

        $Step->save();

        return redirect()->back();
    }

    public function addImgtoStep(\App\Step $Step, Request $request)
    {
        $validator = $request->validate([
            'image' => ['required']
        ]);

        $img = new \App\ImgStep;
        $img->step_id = $Step->id;

        $file = $request->image;
        $name = $file->store('img_steps/'.$Step->id, 'public');
        $img->url = '/storage/'. $name;

        $img->save();

        return redirect()->back();
    }

    public function deleteImgStep(\App\ImgStep $ImgStep)
    {
        $ImgStep->delete();

        return redirect()->back();
    }

    public function showProblemsCourse(\App\Course $Course)
    {
        return view('problem.showProblemsCourse',['course' => $Course]);
    }

    public function showProblemUser(Problem $Problem)
    {
        return view('problem.showProblemUser',['problem' => $Problem]);
    }
}
