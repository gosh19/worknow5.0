<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'alumno', 'vendedor','comision'
    ];

    public function datosAlumno()
    {
        return $this->hasOne('App\User','id','alumno');
    }
    public function datosUser()
    {
        return $this->hasOne('App\DatosUser','user_id','alumno');
    }
    public function datosVendedor()
    {
        return $this->belongsTo('App\User','vendedor','id');
    }
    public function firstCobro()
    {
        $cobro = \App\Cobro::where('user_id',$this->datosAlumno->id)->first();
        return $cobro;
    }

    public function valor()
    {

        $puntosTotales = 0;


            $puntosTotales += $this->puntos_extra; 
            if ($this->datosAlumno->tipo_pago == 'efectivo') {
                $puntosTotales += 0.5;
                
            }else{
                $puntosTotales += 1;
                if ($this->datosAlumno['country'] == 'UY') {
                    $puntosTotales += 0.5;
                }
            }
            if ($this->datosAlumno['kit']) {   
                if ($this->datosAlumno->datosKit != null) {

                    $kit = $this->datosAlumno->datosKit;

                    if ($kit->kit_type_id != null) {

                        $puntosTotales += $kit->kitType->puntos;

                    }else{
                        $puntosTotales += 0.5; //ES PARA LOS DATOS VIEJOS QUE NO TIENEN TIPO DE KIT, SE CUENTA COMO EFECTIVO PORQ ES MEDIO PUNTO
                    }
                } else {
                    $puntosTotales += 0.5; //ES PARA LOS DATOS VIEJOS QUE NO TIENEN TIPO DE KIT, SE CUENTA COMO EFECTIVO PORQ ES MEDIO PUNTO
                }
                
            }

            if ($this->datosUser != NULL) {        //SI ES UY ES MEDIO PUNTO MAS
                if ($this->datosUser->country == 'UY') {
                    $puntosTotales += 0.5;
                }
            }

        return $puntosTotales;
    }
}
