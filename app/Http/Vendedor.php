<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


use App\User;
use App\DatosUser;

class Vendedor extends Model
{
    protected $table = "users";

    public function __construct()
    {
           
    }

    /**
     * Si no trecibe parametro devuelve todos los vendedores, si no devuelve el correspondiente
     */
    public static function getAll($habilitado = null)
    {
        if ($habilitado == null) {
            # code...
            $vendedoras = User::where('rol','vendedor')->get();
        }else{
            $vendedoras = User::where([['rol','vendedor'],['habilitado',$habilitado]])->get();
        }

        return $vendedoras;
    }

    public function ventas()
    {
        return $this->hasMany('App\Venta', 'vendedor', 'id')->where([['estado', 'cerrada'],['alta', 1]]);
    }

    public function ventasCerradasMes($mes = null)
    {
        $hoy = \Carbon\Carbon::now();
        if ($mes == null) {

            $mes = $hoy->month;
        }
        return $this->hasMany('App\Venta', 'vendedor', 'id')
                        ->where('estado', 'cerrada')
                        ->whereMonth('fecha',$mes)
                        ->whereYear('fecha',$hoy->year);
    }

    public function puntosMes($mes = null)
    {

        $ventas = $this->ventasCerradasMes($mes)->where('alta',1)->get();
        $ventasTotales = $this->calculoPuntos($ventas);

        return $ventasTotales;
    }

    public function puntosPorRango($desde,$hasta)
    {
        $ventas = \App\Venta::where([['alta',1],['estado','cerrada'],['vendedor',$this->id]])
                            ->whereBetween('fecha',[$desde,$hasta])
                            ->get();

        $puntos = $this->calculoPuntos($ventas);
        
        return $puntos;
    }

    private function calculoPuntos($ventas)
    {
        $puntosTotales = 0;
        $auxEfectivo = 0;//PARA EL CONTROL DE LA CANTIDAD DE EFECTIVOS
        $puntosExtra = 0;

        foreach ($ventas as $venta) {
            $puntosExtra += $venta->puntos_extra; 
            if ($venta->datosAlumno['tipo_pago'] == 'efectivo') {
                $auxEfectivo++;
                
            }else{
                $puntosTotales++;
                if ($venta->datosAlumno['country'] == 'UY') {
                    $auxEfectivo++;
                }
            }
            if ($venta->datosAlumno['kit']) {   
                if ($venta->datosAlumno->datosKit != null) {

                    $kit = $venta->datosAlumno->datosKit;

                    if ($kit->kit_type_id != null) {

                        $puntosExtra += $kit->kitType->puntos;

                    }else{
                        $auxEfectivo++; //ES PARA LOS DATOS VIEJOS QUE NO TIENEN TIPO DE KIT, SE CUENTA COMO EFECTIVO PORQ ES MEDIO PUNTO
                    }
                } else {
                    $auxEfectivo++; //ES PARA LOS DATOS VIEJOS QUE NO TIENEN TIPO DE KIT, SE CUENTA COMO EFECTIVO PORQ ES MEDIO PUNTO
                }
                
            }

            if ($venta->datosUser != NULL) {        //SI ES UY ES MEDIO PUNTO MAS
                if ($venta->datosUser->country == 'UY') {
                    $auxEfectivo++;
                }
            }

            
        }
        $puntosTotales = $puntosTotales + ($auxEfectivo/2) + $puntosExtra;

        return $puntosTotales;
    }

    /**Recibe el tipo pago y devuelve la cant de ventas en el mes correspondiente de ese tipo */
    public function cantVentaXTipo($case, $mes)
    {
        $ventas = $this->ventasCerradasMes($mes)->get();
        $cant = 0;



        foreach ($ventas as $key => $venta) {
            if ($case == 'kit') {
                if ($venta->datosAlumno->kit ) {
                    $cant++;
                }
            }elseif($case == 'UY'){
                if ($venta->datosAlumno->datosUser != null) {
                    # code...
                    if ($venta->datosAlumno->datosUser->country == $case ) {
                        $cant++;
                    }
                }
            }
            else{

                if ($venta->datosAlumno->tipo_pago == $case) {
                    $cant++;
                }elseif (($case == 'credito')&& ($venta->datosAlumno->tipo_pago == null)) {
                    $cant++;
                }
            }
        }

        return $cant;
    }

    public function IngresosMes($mes = null)
    {
        $hoy = \Carbon\Carbon::now();

        if ($mes == null) {
            $mes= $hoy->month;
        }


        return $this->hasMany('App\Ingreso', 'user_id', 'id')->whereMonth('created_at',$mes)->whereYear('created_at',$hoy->year);
        
    }

    public function rendimiento($mes = null)
    {
        $hoy = \Carbon\Carbon::now();
        $mesHoy = $hoy->month;
        $diaHoy = $hoy->day;

        if ($mes != null) {
            $mesHoy = $mes;
        }

        if ($hoy->month != $mesHoy) {
            $dt = \Carbon\Carbon::parse($hoy->year.'-'.$mesHoy.'-'.$diaHoy);
            $diaHoy = $dt->daysInMonth;
        }
        $auxTotal = 0;
        $catnDias = 1;
        for ($i=1; $i <= $diaHoy; $i++) { 
            $dt = \Carbon\Carbon::parse($hoy->year.'-'.$mesHoy.'-'.$i);
            if (($dt->dayOfWeek != 6) && ($dt->dayOfWeek != 0)) { //CONTROLO Q SEA UN DIA DE SEMANA
                # code...
                $ventasVendedoraDia = \App\Venta::where([['vendedor',$this->id],['estado', 'cerrada']])
                                                    ->whereYear('fecha',$hoy->year)
                                                    ->whereMonth('fecha', $mesHoy)
                                                    ->whereDay('fecha', $i)
                                                    ->get();
                $auxCant = count($ventasVendedoraDia);
                $auxTotal += $auxCant;
                $catnDias++;
            }
        }
        $rendimiento  = $auxTotal/($catnDias-1);
        return number_format($rendimiento,2);
    }
}
