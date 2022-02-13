<?php

namespace App\Http\Controllers;

use App\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TiendaController extends Controller
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

    public function accesoAdmin()
    {
        $categorias = \App\Categoria::orderBy('order','asc')->get();
        $courses = \App\Course::orderBy('nombre','asc')->get();

        return view('tienda.admin.index',['categorias' => $categorias, 'courses' => $courses]);
    }

    public function setCourseInfo(\App\Course $course, Request $request)
    {
        $info = \App\CourseInfo::firstOrNew(['course_id'=>$course->id]);

        $info->peso = $request->peso;
        $info->dolar = $request->dolar;
        $info->discount = $request->discount;
        $info->on = $request->on == "on"? true:false;
        $info->free = $request->free == "on"? true:false;
        $info->people = $request->people;
        $info->score = $request->score;

        $info->save();

        return redirect()->back();
    }

    public function cargarDato(Request $request, \App\Course $course = null)
    {
        if((str_contains($request->name, 'http')) || ($request->phone == "+1 213 425 1453")){
            return redirect('/inscripcion');
        }
        
        echo "<script>
            gtag('event', 'conversion', {'send_to': 'AW-1001943045/ACHACI_xn64BEIXg4d0D'});
        </script>";

        $control = DB::connection('crm')->table('datos')->where(['email' => $request->email])->get();
        $control = $control->last();

        $now = \Carbon\Carbon::now();
        
        $fechaDato = null;  //INICIO EN NULL PARA CONTROLD E SI EXISTE ELD ATO O NO
        
        if (isset($control->updated_at)) {
            $fechaDato = new \Carbon\Carbon($control->updated_at);
        
        }
        $platform = $request->platform == null? 'web':$request->platform;

        if (($now->diffInMonths($fechaDato) > 1) || ($fechaDato == null)) {

            DB::connection('crm')->table('datos')->insert(
                [
                    'name' => $request->name, 
                    'email' => $request->email,
                    'telefono' => $request->phone,
                    'pedido' => $course->nombre,
                    'platform' => $platform,
                    'hora_contacto' => $request->horario,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]
            );

            if (!session()->has('selected.0')) {
                session()->put('selected.0', $course);
            }else if (!session()->has('selected.1')) {
                session()->put('selected.1', $course);
            }else if (!session()->has('selected.2')) {
                session()->put('selected.2', $course);
            }

        }

        return redirect('/inscripcion');
    }

}
