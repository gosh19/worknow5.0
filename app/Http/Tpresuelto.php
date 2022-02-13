<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tpresuelto extends Model
{
  public function Tp()
  {
    return $this->belongsTo('App\Tp');
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }
/*
  public function scores(){
      return $this->hasMany('App\Score');
  }*/
  public function score()
  {
      return $this->belongsTo('App\Score', 'id', 'tpresuelto_id');
  }

}
