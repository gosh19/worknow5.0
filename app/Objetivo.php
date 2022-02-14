<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    protected $fillable = [
        'referencia', 'cantidad_cursos', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public static function getObjMonth($mes = null)
    {
        $hoy = \Carbon\Carbon::now();
        if ($mes == null) {
            $mes = $hoy->month;
        }

        $objetivo = \App\Objetivo::whereYear('created_at',$hoy->year)->where('mes',$mes)->first();

        if ($objetivo == null) {
            $objetivo = new \App\Objetivo;
            $objetivo->referencia = 'General';
            $objetivo->cantidad_cursos = 21;
            $objetivo->mes = $mes;
            $objetivo->save();

        }

        return $objetivo;
    }
}
