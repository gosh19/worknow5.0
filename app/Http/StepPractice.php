<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StepPractice extends Model
{
    public function imgs()
    {
        return $this->hasMany('App\ResourceStepPractice');
    }
}
