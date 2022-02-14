<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tp extends Model
{
  public function unity()
  {
      return $this->belongsTo('App\Unity');
  }
  public function scores()
  {
      return $this->hasMany('App\Score')->where('user_id',Auth::user()->id);
  }
  public function scoreAprobadoUser()
  {
      $aprobados = $this->hasMany('App\Score')->where([['user_id',Auth::user()->id],['nota','aprobado']])->first();

      if ($aprobados == null) {
          return false;
      }
      return true;
  }

  public function scoreAprobado($id)
  {
      return $this->hasOne('App\Score')->where([['user_id', $id], ['nota_numerica' ,'>=', 7]]);
  }

  public function scoreUser($id)
  {
      
      return $this->hasOne('App\Score')->where('user_id', $id)->orderBy('id','desc')->first();
  }
  public function Tpresueltos()
  {
      return $this->hasMany('App\Tpresuelto');
  }

}
