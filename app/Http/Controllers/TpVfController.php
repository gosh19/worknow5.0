<?php

namespace App\Http\Controllers;

use App\TpVf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TpVfController extends Controller
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
    public function create(Request $request)
    {
        $tp = TpVf::find($request->tp_id);
        return view('crearCurso.form-tp-vf',['tp' => $tp, 'unity_id' => $request->unity_id]);
    }

    public function newAfirmation(Request $request)
    {
        if ($request->tp_id == null) {
            $tp = new TpVf;
            $tp->unity_id = $request->unity_id;
            $tp->save();
        }else{
            $tp = TpVf::find($request->tp_id);
        }

        if ($request->afirmation_id == null) {
            $afirmation = new \App\AfirmationVf;
            $afirmation->tpvf_id = $tp->id;
        } else {
            $afirmation = \App\AfirmationVf::find($request->afirmation_id);
        }
        

        $afirmation->afirmation = $request->afirmation;
        $afirmation->true = ($request->value == 'on') ? true:false;
        $afirmation->save();

        return redirect()->route('TpVf.create',['unity_id' => $request->unity_id, 'tp_id' => $tp->id]);
    }
    public function deleteAf(Request $request)
    {
        \App\AfirmationVf::find($request->id)->delete();

        return redirect()->route('TpVf.create',['unity_id' => $request->unity_id, 'tp_id' => $request->tp_id]);
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
     * @param  \App\TpVf  $tpVf
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tp = TpVf::find($id);
        if (($tp->score == null) || (($tp->score->nota ?? 0)<7)) {
            $tpsDes =array();
            foreach ($tp->afirmations as $key => $value) {
                array_push($tpsDes,$value);
            }
            shuffle($tpsDes);
            
            return view('alumno.show-tp-vf',['tp'=>$tp, 'tpDes'=>$tpsDes]);
        }
        return view('alumno.show-tp-vf',['tp'=>$tp, 'data' => 1]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TpVf  $tpVf
     * @return \Illuminate\Http\Response
     */
    public function edit(TpVf $tpVf)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TpVf  $tpVf
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TpVf $tpVf)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TpVf  $tpVf
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tp = TpVf::find($id);
        $tp->delete();
        return redirect()->back();
    }
}
