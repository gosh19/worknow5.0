<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function tp()
  {
    return $this->belongsTo('App\Tp');
  }

  public function exam()
  {
    return $this->belongsTo('App\Exam');
  }
  public function tpResuelto()
  {
      return $this->hasOne('App\Tpresuelto', 'id', 'tpresuelto_id');
  }
}
