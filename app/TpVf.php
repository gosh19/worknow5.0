<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TpVf extends Model
{
    public function afirmations()
    {
        return $this->hasMany('App\AfirmationVf', 'tpvf_id', 'id');
    }
    public function unity()
    {
        return $this->belongsTo('App\Unity');
    }
    public function score($id = null)
    {
        if ($id == null) {
            $id = Auth::user()->id;
            return $this->hasOne('App\ScoreTpVf','tp_id', 'id')->where('user_id', $id);
        }
        return $this->hasOne('App\ScoreTpVf','tp_id', 'id')->where('user_id', $id)->get();
    }
    public function scoreAprobadoUser()
    {
        $aprobados = $this->hasMany('App\ScoreTpVf','tp_id','id')->where([['user_id',Auth::user()->id],['nota','>=',7]])->first();

        if ($aprobados == null) {
            return false;
        }
        return true;
    }
}
