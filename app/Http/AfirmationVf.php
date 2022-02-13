<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AfirmationVf extends Model
{
    public function tp()
    {
        return $this->belongsTo('App\TpVf', 'tpvf_id', 'id');
    }
}
