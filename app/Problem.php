<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    public function course()
    {
        return $this->belongsTo('App\Course');
    }
    public function steps()
    {
        return $this->hasMany('App\Step')->orderBy('numero','asc');
    }
}
