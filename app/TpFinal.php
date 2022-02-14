<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TpFinal extends Model
{
    public function resoluciones()
    {
        return $this->hasMany('App\TpFinalResuelto', 'tpF_id', 'id');
    }
    public function state()
    {
        $score = \App\TpFinalResuelto::where([['user_id',Auth::user()->id],['tpF_id',$this->id]])->orderBy('id','Desc')->first();

        if ($score == null) {
            return null;
        }else {
            return $score->estado;
        }
    }
    public function unity()
    {
        return $this->belongsTo('App\Unity');
    }
}
