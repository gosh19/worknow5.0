<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cobro extends Model
{
    protected $fillable = [
        'user_id', 'numero_operacion', 'cuenta_id', 'monto'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id','user_id')->with('datosUser');
    }
    public function cuenta()
    {
        return $this->belongsTo('App\Cuenta');
    }

    /**
     * calcula el promedio en plata de un rande de dias dentro de un mes
     */
    public static function promedio($inicial, $final,$mes)
    {
        $hoy = Carbon::now();

        $totalPromedio = 0;
        $cantDias = 0;

        for ($i=$inicial; $i <= $final; $i++) {
            $dt = Carbon::parse($hoy->year.'-'.$hoy->month.'-'.$i);
            if (($dt->dayOfWeek != 6) && ($dt->dayOfWeek != 0)) {

                $cantDias++;
                $cobrosProm = \App\Cobro::whereDate('fecha',$dt)->get();

                foreach ($cobrosProm as $x => $value) {
                    $totalPromedio += $value->monto;
                }
            }

        }

        if ($cantDias == 0) {
            $cantDias = 1;
        }
        $promedio = $totalPromedio/$cantDias;

        return $promedio;

    }

}
