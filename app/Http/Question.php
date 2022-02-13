<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  public function exam()
  {
      return $this->belongsTo('App\Exam');
  }

  public function answers()
  {
      return $this->hasMany('App\Answer');
  }

}
