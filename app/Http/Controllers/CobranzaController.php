<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

use App\Mail\CuotaAlumnoMail;

use App\Cobro;

class CobranzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = null;
        if ($request->id != null) {
            $user = \App\User::find($request->id);
            $user->cobros;
            $user->infoFac;
            $user->datosUser;
            $user->adicionales;
        }
        return view('cobranza.index', ['user' => $user]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //try {
            $cobro = new \App\Cobro;

            $cobro->user_id = $request->userId;
            $cobro->cuenta_id = $request->cuentaId;
            $cobro->tipo = $request->tipoCobro;
            $cobro->numero_operacion = $request->numeroOperacion;
            $cobro->cant_cuotas = $request->cantCuotas;
            $cobro->monto = $request->monto;

            $date = Carbon::parse($request->fecha)->format('Y-m-d');

            $cobro->fecha = $date; 

            $cobro->save();



            $user = \App\User::find($request->userId);
            $infoFac = \App\InfoFac::find($request->userId);

            $cant = 0;
            foreach ($user->cobros as $cobro) { /**MODFICAR PARA Q TOME LOS ADICIONALES */
                switch ($cobro->tipo) {
                    case 0:         //CUOTA NORMAL
                        $cant = $cant + $cobro->cant_cuotas;
                        break;
                    case 1:         //CUOTA NORMAL + ADICIONAL
                        $cant = $cant + ($cobro->cant_cuotas * 2);
                        break;
                    case 2:         //CUOTA ADICIONAL
                        $cant = $cant + $cobro->cant_cuotas;
                        break;
                    default:
                        # code...
                        break;
                }
                
            }

            $cuotas_totales = $infoFac->cant_cuotas;        //sumo las cuotas del curso mas todas las adicionales
            foreach ($user->adicionales as $key => $ad) {       
                $cuotas_totales = $cuotas_totales + $ad->cant_cuotas;
            }

            if ($cant >= $cuotas_totales) {
                $infoFac->cobrable = 0;
            }
            

            $fechaAnt = Carbon::parse($request->fecha);
            $fechaAnt->month = $fechaAnt->month + $request->cantCuotas;
            $infoFac->fecha_sig_cobro = $fechaAnt->format('Y-m-d H:i:s');
            $infoFac->save();

            if (Auth::user()->rol == 'supervisor') {
                return redirect()->back();
            }

            return ['estado' => 1];
            /** 
        } catch (\Throwable $th) {
            return ['estado' => 0, 'error' => $th];
        }
        */

        return [$date] ;
    }

    public function modificarFondos($id)
    {
        try {
            $infoFac = \App\InfoFac::find($id);

            $infoFac->fondos = !$infoFac->fondos;

            $infoFac->save();

            return ['estado' => 1];
        } catch (\Throwable $th) {
            //throw $th;
            return ['estado' => 0];
        }
        
    }

    public function formModificarInfoFac($user_id)
    {
        $infoFac = \App\InfoFac::find($user_id);

        $hoy = Carbon::now();
        $hoy = date_format($hoy, 'Y-m-d');

        return view('cobranza.modificar-info-fac-view', ['info_fac' => $infoFac, 'user_id' => $user_id, 'fecha_sig_cobro' => $hoy]);
    }

    public function modificarInfoFac(Request $request)
    {
        $infoFac = \App\InfoFac::find($request->user_id);

        if ($infoFac == null) {
            $infoFac = new  \App\InfoFac;
        }

        $infoFac->user_id = $request->user_id;
        $infoFac->monto_cuota = $request->valor_cuota;
        $infoFac->cant_cuotas = $request->cant_cuotas;
        $infoFac->fecha_sig_cobro = $request->fecha_sig_cobro;

        $infoFac->save();

        return redirect()->route('User.modificarAlumno',['id' => $request->user_id]);
    }

    public function getCobrosMes($mes = null)
    {
        if ($mes == null) {
            $mes = Carbon::now()->month;
        }

        try {
            $cobros = \App\InfoFac::whereMonth('fecha_sig_cobro', $mes)
                                    ->where('cobrable', 1)
                                    ->orderBy('fecha_sig_cobro', 'Asc')
                                    ->with('user')
                                    ->get();


            foreach ($cobros as $cobro) {
                if (count($cobro->user->cobros) != 0) {
                    $cobro->user->kit = 0;
                }
                $datosUser = \App\DatosUser::find($cobro->user_id);
                $cobro->datos_user = $datosUser;
                if ($cobro->user->kit) {
                    if ($cobro->user->datosKit != null) {
                        if ($cobro->user->datosKit->kit_type_id != null) {
                            $cobro->user->datosKit->kitType;
                            
                        }
                    }
                }
            }
            return $cobros;
        } catch (\Throwable $th) {
            //throw $th;
            return ['error' => $th];
        }

    }

    public function getCobrosHechos($mes = null)
    {
        if ($mes == null) {
            $mes = Carbon::now()->month;
        }

        try {
            $cobros = Cobro::whereMonth('fecha', $mes)->orderBy('fecha', 'Desc')->with('user')->get(); 
            $total = 0;
            foreach ($cobros as   $cobro) {
                $total += $cobro->monto;
            }
            return ['cobros' => $cobros, 'total' => $total];
        } catch (\Throwable $th) {
            return $th;
        }
        return 0;
    }

    public function modificarCobrable($id, $case = null)
    {
        $infoFac = \App\InfoFac::find($id);

        $infoFac->cobrable = !$infoFac->cobrable;

        $infoFac->save();

        if ($case != null) {
            return ['estado' => 1];
        }

        return redirect()->back()->with('success','success');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cobros = Cobro::where('user_id', $id)->get();

        return $cobros;
    }

    public function cargarFactura($id, $factura = -1)
    {
        $vacio = 0;
        try {
            $cobro = Cobro::find($id);
            if ($factura == -1) {
               $factura = null;
               $vacio = 1;
            }
            $cobro->factura = $factura;

            $cobro->save();

            return ['estado' => 1, 'vacio' => $vacio];
        } catch (\Throwable $th) {
            //throw $th;
            return ['estado' => 0, 'error' => $th];
        }
    }

    public function sendCuotaMail($id, $case)
    {
        $user = \App\User::find($id);
        $cupon = \App\Cupon::find(1);

        $fecha = new Carbon($user->infoFac->fecha_sig_cobro);

        $fecha->day = $fecha->day +5;

        try {
            //Mail::to($user->email)->send(new CuotaAlumnoMail($user,$cupon,$fecha));
            if ($case == 'react') {
                return ['estado' => 1];
            }
        } catch (\Throwable $th) {
            //throw $th;
            return ['estado' => 0, 'error' => $th->getMessage()];
        }
        return redirect()->back()->with('success','success');
    }

    public function editCobro(Request $request)
    {
        try {
            
            $cobro = Cobro::find($request->id);
            
            $cobro->monto = $request->monto;
            $cobro->numero_operacion = $request->numOperacion;
            $cobro->fecha = new Carbon($request->date);
            $cobro->save();

            return ['estado' => 1, 'cobro' => $cobro];
        } catch (\Throwable $th) {
            //throw $th;
            return ['estado' => 0, 'error' => $th->getMessage()];
        }
        
        return $cobro;
    }

    public function getVentasPorDia($mes = null)
    {
        $hoy = Carbon::now();
        $mesHoy = $hoy->month;
        $diaHoy = $hoy->day;
        if ($mes != null) {
            $mesHoy = $mes;
        }

        $vendedoras = \App\Vendedor::getAll();
        $ventas = array();
        foreach ($vendedoras as $key => $vendedora) {
            $ventasDia = (object) array('name' =>$vendedora->name, 'VentasPorDia' => array(), 'rendimiento' => 0);
            if ($hoy->month != $mesHoy) {
                $dt = Carbon::parse($hoy->year.'-'.$mesHoy.'-'.$diaHoy);
                $diaHoy = $dt->daysInMonth;
            }
            $auxTotal = 0;
            $cantDias = 1;
            for ($i=1; $i <= $diaHoy; $i++) { 
                $dt = Carbon::parse($hoy->year.'-'.$mesHoy.'-'.$i);
                if (($dt->dayOfWeek != 6) && ($dt->dayOfWeek != 0)) { //CONTROLO Q SEA UN DIA DE SEMANA
                    # code...
                    $ventasVendedoraDia = \App\Venta::where([['vendedor',$vendedora->id],['estado', 'cerrada']])
                                                        ->whereMonth('fecha', $mesHoy)
                                                        ->whereDay('fecha', $i)
                                                        ->get();
                    $auxCant = count($ventasVendedoraDia);
                    $auxTotal += $auxCant;
                    $auxDataDia = (object) array('dia'=> $i,'cant'=>$auxCant );                               
                    array_push($ventasDia->VentasPorDia,$auxDataDia);
                    $cantDias++;
                }
            }
            $ventasDia->rendimiento = number_format($auxTotal/($cantDias-1),2);
            array_push($ventas,$ventasDia);
        }

        return $ventas;
    }

    public function adicionalCreate(Request $request)
    {

        $adicional = new \App\Adicional;

        $adicional->user_id = $request->user_id;
        $adicional->valor = $request->valor_cuota;
        $adicional->cant_cuotas = $request->cant_cuotas;
        $adicional->denominacion = $request->denominacion;

        $adicional->save();

        return redirect()->back();
    }

    public function adicionalDelete(\App\Adicional $Adicional)
    {
        $Adicional->delete();

        return redirect()->back();
    }

    public function downloadCobros($mes)
    {
        $hoy = Carbon::now();

        return (new \App\Exports\CobrosExport($mes))->download('cobros-'.$mes.'--'.$hoy.'.xlsx');
    }

    public function verVentasRango(Request $request)
    {
        $hoy = Carbon::now();    
        $operarios = \App\Vendedor::getAll();



        $totalPromedio = 0;
        $cantDias = 0;
        $promedio = 0;

        if ($request->desde == null) {

            $promedio = \App\Cobro::promedio(1, $hoy->day, $hoy->month);

            $ventas = \App\Venta::whereMonth('fecha',$hoy->month)
                                ->whereYear('fecha',$hoy->year)
                                ->where([['estado','cerrada'],['alta',1]])
                                ->get();
            foreach ($operarios as $key => $op) {

                $op->cant =  \App\Venta::whereMonth('fecha',$hoy->month)
                                        ->whereYear('fecha',$hoy->year)
                                        ->where([['estado','cerrada'],['alta',1],['vendedor',$op->id]])
                                        ->get();
            }

            $cobros = \App\Cobro::whereMonth('fecha',$hoy->month)
                                    ->whereYear('fecha',$hoy->year)
                                    ->get();
            
        }else{
            $ventas = \App\Venta::whereBetween('fecha',[$request->desde,$request->hasta])
                                ->where([['estado','cerrada'],['alta',1]])
                                ->get();
            
            foreach ($operarios as $key => $op) {

                $op->cant =  \App\Venta::whereBetween('fecha',[$request->desde,$request->hasta])
                    ->where([['estado','cerrada'],['alta',1],['vendedor',$op->id]])
                    ->get();

                
            }

            $cobros = \App\Cobro::whereBetween('fecha',[$request->desde,$request->hasta])
                                    ->get();
            
            //AGARRO DIAS Y MESES DEL REQUEST
            $diaInicial = date('d',strtotime($request->desde));
            $mesInicial = date('m',strtotime($request->desde));

            $diaFinal = date('d',strtotime($request->hasta));
            $mesFinal = date('m',strtotime($request->hasta));

           

            if ($mesInicial == $mesFinal) {

                $promedio = \App\Cobro::promedio($diaInicial, $diaFinal, $mesFinal);
                
            }else{
                //ACA ME ESTA FALLANDO LA FUNCION DE PROMEDIO CUANDO HAGO PROMEDIO ACUMULADO PERO FUE XD
                $bandera = true;

                for ($j=$mesInicial; $j <= $mesFinal; $j++) { 
                    $currentMonth = Carbon::parse($hoy->year.'-'.$j.'-1');

                    if ($bandera) {
                        $bandera = false;

                        for ($i=$diaInicial; $i <= $currentMonth->daysInMonth ; $i++) {
    
                            $dt = Carbon::parse($hoy->year.'-'.$j.'-'.$i);
                            if (($dt->dayOfWeek != 6) && ($dt->dayOfWeek != 0)) {
        
                                $cantDias++;
                                $cobrosProm = \App\Cobro::whereDate('fecha',$dt)->get();
        
                                foreach ($cobrosProm as $x => $value) {
                                    $totalPromedio += $value->monto;
                                }
                            }
        
                        }

                    }else{
                        if ($j == $mesFinal) {
                            for ($i=1; $i <= $diaFinal ; $i++) {
    
                                $dt = Carbon::parse($hoy->year.'-'.$j.'-'.$i);
                                if (($dt->dayOfWeek != 6) && ($dt->dayOfWeek != 0)) {
            
                                    $cantDias++;
                                    $cobrosProm = \App\Cobro::whereDate('fecha',$dt)->get();
            
                                    foreach ($cobrosProm as $x => $value) {
                                        $totalPromedio += $value->monto;
                                    }
                                }
            
                            }
                        }else{
                            for ($i=1; $i <= $currentMonth->daysInMonth ; $i++) {
    
                                $dt = Carbon::parse($hoy->year.'-'.$j.'-'.$i);
                                if (($dt->dayOfWeek != 6) && ($dt->dayOfWeek != 0)) {
            
                                    $cantDias++;
                                    $cobrosProm = \App\Cobro::whereDate('fecha',$dt)->get();
            
                                    foreach ($cobrosProm as $x => $value) {
                                        $totalPromedio += $value->monto;
                                    }
                                }
            
                            }
                        }
                    }

                }

                $promedio = $totalPromedio/$cantDias;
                
            }
        }

        $total = 0;

        foreach ($cobros as $key => $cobro) {
            $total += $cobro->monto;
        }

        
        return view('cobranza.ventas-view',[
                                            'ventas'=> $ventas, 
                                            'operarios' => $operarios,
                                            'total' => $total,
                                            'promedio' => number_format($promedio,2),
                                            ]);
    }

}
