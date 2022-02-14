<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Unity extends Model
{
  protected $fillable = [
    'nombre', 'descripcion',
  ];

    public function exams(){
      return $this->hasMany('App\Exam');
    }


    public function courses(){
      return $this->belongsToMany('App\Course');
    }

    public function modules()
    {
      return $this->hasMany('App\Module');
    }

    public function tps()
    {
      return $this->hasMany('App\Tp');
    }
    public function tpsAprobados()
    {
        $tps = $this->tps;
        $cantAprobados = 0;
        foreach ($tps as $key => $value) {
          if ($value->scoreAprobadoUser()) {
            $cantAprobados++;

          }
        }
        $tpsVf = $this->tpsVf;
        foreach ($tpsVf as $key => $value) {
          if ($value->scoreAprobadoUser()) {
            $cantAprobados++;

          }
        }

        return $cantAprobados;
    }
    public function videos()
    {
      return $this->hasMany('App\Video');
    }

    public function videosYT()
    {
        return $this->hasMany('App\VideosYT');
    }

    public function tpsFinals()
    {
        return $this->hasMany('App\TpFinal');
    }
    public function tpsVf()
    {
        return $this->hasMany('App\TpVf');
    }
}
