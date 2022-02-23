<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Arr;

use App\Mail\CadenaMail;
use App\Mail\CuotaAlumnoMail;
use App\Mail\AlumnosMail;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $i = 0;
        $alumno = array();
        $vendedor = array();
        $hoy = Carbon::now();
        $user = User::find(Auth::user()->id);
        $ventasMes = \App\Venta::whereMonth('fecha', $hoy->month)
                                ->whereYear('fecha',$hoy->year)
                                ->where([['estado','cerrada'],['alta',1]])
                                ->orderBy('fecha','DESC')
                                ->get();

        $consultas = \App\Consulta::where('visto',0)->get();
        $userTest = \App\UserTest::where('visto', 0)->get();
        $ingresos = \App\Anuncio::whereDate('updated_at',$hoy)->get();
        $practicas = \App\ConverPractice::where('admin',0)->get();

        $ingresosVendedoras = \App\Ingreso::whereDate('created_at',$hoy)->get();

        $tiendaPendiente = \App\Carrito::where('estado','pendiente')->get();

        $avisosPago = \App\AvisoPago::where('visto',0)->get();

        return view('admin.admin', [
                                    'user' => $user, 
                                    'ventasMes' => $ventasMes, 
                                    'notificacion' => count($consultas),
                                    'tiendaPendiente' => $tiendaPendiente,
                                    'notificacionTest' => count($userTest),
                                    'practicas' => count($practicas),
                                    'ingresos' => $ingresos,
                                    'ingresosVendedoras' => $ingresosVendedoras,
                                    'avisosPago' => $avisosPago,
                                    ]);
    }

    public function cargarVendedor(Request $request)
    {
        $venta = new \App\Venta;

        $venta->alumno = $request->alumno;
        $venta->vendedor = $request->vendedor;
        $venta->estado = "cerrada";

        $venta->save();

        return redirect()->back();
    }

    public function verVendedoras()
    {
        
        $mes = Carbon::now()->month;
        $year = Carbon::now()->year;

        $vendedoras = \App\Vendedor::getAll(true);


        foreach ($vendedoras as $vendedora ) {

            $ventasAlta = \App\Venta::whereMonth('fecha', $mes)
                                    ->whereYear('fecha',$year)
                                    ->where([
                                        ['vendedor', $vendedora->id],
                                        ['estado', 'cerrada'],
                                        ['alta', 1],
                                        ])->get();
            $vendedora->ventasAlta = $ventasAlta;
            $vendedora->comision = 0;
            foreach ($ventasAlta as $j => $venta) {
                $vendedora->comision += $venta->comision;
            }
            
            $ventasBaja = \App\Venta::whereMonth('updated_at', $mes)
                                        ->where([
                                            ['vendedor', $vendedora->id],
                                            ['estado', 'cerrada'],
                                            ['alta', 0],
                                            ])->get();

            $vendedora->ventasBaja = $ventasBaja;      

        }

        return view('admin.verVendedoras',['vendedoras'=>$vendedoras]);
    }

    /**
     * devuelve las ventas del mes con los vendedores
     */
    public function getVendedoras($mes = 0)
    {
        $vendedoras = User::where('rol', 'vendedor')->get();

        if ($mes == 0) {
            $mes = Carbon::now()->month;
        }
        $year = Carbon::now()->year;

        $objetivo = \App\Objetivo::getObjMonth($mes);

        foreach($vendedoras as $vendedora){
            $vendedora->objetivo = $objetivo;

            $vendedora->ventasAlta = \App\Venta::where([
                                                        ['vendedor' , $vendedora->id],
                                                        ['estado', 'cerrada'],
                                                        ['alta', 1]
                                                        ])
                                                ->whereMonth('fecha', $mes)
                                                ->whereYear('fecha',$year)
                                                ->with('datosAlumno','datosUser')
                                                ->get();

            $vendedora->ventasBaja = \App\Venta::where([
                                                        ['vendedor' , $vendedora->id],
                                                        ['estado', 'cerrada'],
                                                        ['alta', 0]
                                                        ])
                                                ->whereMonth('fecha', $mes)
                                                ->whereYear('fecha',$year)
                                                ->with('datosAlumno')
                                                ->get();
            
            $vend = \App\Vendedor::find($vendedora->id);
            
            $vendedora->puntos = $vend->puntosMes($mes);
        }

        return $vendedoras;
    }

    public function verVentasMes($mes = 0)
    {
        $hoy = Carbon::now();
        if ($mes == 0) {
            $mes = $hoy->month;
        }

        $ventasMes = \App\Venta::whereMonth('fecha', $mes)
                                ->whereYear('fecha',$hoy->year)
                                        ->where([['estado','cerrada'],['alta',1]])
                                        ->orderBy('id','DESC')
                                        ->get();
        $cantidades = [];
        $provincias = [];
        $vendedoras = [];

        foreach ($ventasMes as $key => $venta) {
            foreach ($venta->datosAlumno->courses as $course) {
                if (!Arr::exists($cantidades,$course->nombre)) {
                    $cantidades[$course->nombre] = ['id'=>$course->id,'nombre'=>$course->nombre, 'cant'=> 1];
                }else{
                    $cantidades[$course->nombre]['cant']++;
                }
            }
            

            if ($venta->datosUser != null) {
                if (!Arr::exists($provincias,$venta->datosUser->provincia)) {
                    $provincias[$venta->datosUser->provincia] = ['provincia'=>$venta->datosUser->provincia, 'cant'=> 1];
                }else{
                    $provincias[$venta->datosUser->provincia]['cant']++;
                }
            }
            
            if (!Arr::exists($vendedoras,$venta->datosVendedor->name)) {
                if ($venta->firstCobro() != null) {
                    $vendedoras[$venta->datosVendedor->name] = ['name'=>$venta->datosVendedor->name, 'cant'=> 1,'facturado'=> $venta->firstCobro()->monto];
                }
            }else{
                $vendedoras[$venta->datosVendedor->name]['cant']++;
                if ($venta->firstCobro() != null) {
                    $vendedoras[$venta->datosVendedor->name]['facturado'] +=$venta->firstCobro()->monto;
                }
            }
            
        }

        $valores = [];

        foreach ($cantidades as $key => $cant) {
            $valores[$cant['nombre']] = $cant['cant'];
        }
        arsort($valores);


        return view('admin.verVentas', [
                                        'ventasMes' => $ventasMes, 
                                        'mes' => $mes, 
                                        'valores'=>$valores, 
                                        'provincias' => $provincias,
                                        'vendedoras' => $vendedoras,
                                        ]);
    }

    public function verUserTest()
    {
        //DESPUES PONER MAS FILTROS
        $usersTest  = \App\UserTest::where('test', 1)->orderBy('user_id', 'DESC')->take(100)->get();

        //PONGO A LOS NO VISTOS EN VISTOS PERO SIN PASARLOS A LA VIEW
        $noVistos = \App\UserTest::where('visto', 0)->get();
        foreach ($noVistos as $aux ) {
            $aux->visto = 1;
            $aux->save();
        }

        return view ('admin.verUserTest', ['usersTest' => $usersTest]);
    }

    public function verBuscador()
    {
        return view('admin.buscador');
    }
    public function envioCadenaMail(Request $request)
    {
 
        try {
            # code...
            $users = \App\Course::find($request->curso_id)->users()->get();
            
            foreach ($users as $user ) {
                $request->nombre = $user->name;
                if ($request->has('unidad_id')) {
                    try {
                        if (($user->habilitado == 1)&&($user->tipo_pago != 'test')) {
                            //Mail::to($user->email)->queue(new CadenaMail($request));
                        }
                    } catch (\Throwable $th) {
                        echo $th->getMessage();
                    }
                }else{
                    try {
                        if (($user->habilitado == 1)&&($user->tipo_pago != 'test')) {
                            $data = null;
                            $data['msj'] = $request->texto;
                            $data['subject'] = $request->subject;
                            //Mail::to($user->email)->queue(new AlumnosMail($user,'cadenaMail' ,$data));
                        }
                    } catch (\Throwable $th) {
                        //throw $th
                        echo $th->getMessage();
                    }
                }
            }

            return redirect('/');

        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
    }

    public function habilitarDiploma(Request $request)
    {
        $recibido = \App\Recibido::firstOrCreate([
                                                'user_id'=> $request->user_id,
                                                'course_id' => $request->course_id
                                                ]);

        return redirect()->back();
    }

    public function deleteDiploma(\App\Recibido $Recibido)
    {
        $Recibido->delete();

        return redirect()->back();

    }

    public function verRotulo(\App\User $User)
    {
        return view('admin.modificarAlumno.rotuloEnvio',['user' => $User]);
    }
    
    public function cargarProductos(Request $request, \App\User $User)
    {
        $validator = $request->validate([
            'cantidad' => ['required','integer'],
        ]);

        return view('admin.modificarAlumno.cargarProductos',['user' => $User, 'cant' => $request->cantidad]);
    }
    public function verComprobante(Request $request, \App\User $User)
    {
        $data = [];
        foreach ($request->name as $key => $name) {
            $data[$key]['name'] = $name;
            $data[$key]['codigo'] = $request->codigo[$key];
            $data[$key]['valor'] = $request->valor[$key];
            $data[$key]['cant'] = $request->cant[$key];
        }
        return view('admin.modificarAlumno.comprobante',['user' => $User,'data'=>$data]);
    }

}
