<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TpFinalResuelto extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function tpFinal()
    {
        return $this->belongsTo('App\TpFinal', 'tpF_id', 'id');
    }
}
