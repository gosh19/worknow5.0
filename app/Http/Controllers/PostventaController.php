<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostventaController extends Controller
{
    public function index()
    {
        $practicas = \App\ConverPractice::where('admin',0)->get();

        return view('postventa.index',['practicas' => $practicas]);
    }

    public function showPracticeUser(\App\ConverPractice $Conver,$user_id)
    {
        $Conver->admin = true;
        $Conver->save();
        
        $Practice = $Conver->practice;
        return view('practice.postventa.index',['practice'=>$Practice,'user_id'=>$user_id]);
    }
}
