<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfGeneratorController extends Controller
{
    public function imprimir(Request $request){
        
        $user = \App\User::find($request->user_id);
        $course = \App\Course::find($request->course_id);
        $course->promedio = $course->promedio($user_id); 
        $pdf = \PDF::loadView('pdf.diploma',['user' => $user,'course' => $course])->setPaper('a4', 'landscape');
        return $pdf->download('ejemplo.pdf');
   }
}
