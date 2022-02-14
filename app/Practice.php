<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function steps()
    {
        return $this->hasMany('App\StepPractice')->orderBy('numero','asc');
    }

    public function imgs()
    {
        return $this->hasMany('App\ResourcePractice');
    }

    public function conversation($user_id)
    {
        return $this->hasOne('App\ConverPractice')->where('user_id',$user_id)->first();
    }
}
