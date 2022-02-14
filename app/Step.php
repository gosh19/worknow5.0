<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    public function imgStep()
    {
        return $this->hasMany('App\ImgStep');
    }
}
