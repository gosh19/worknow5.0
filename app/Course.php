<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Course extends Model
{
  protected $fillable = [
    'nombre','descripcion','url_img', 'url_temario'
  ];

  public function users()
  {
    return $this->belongsToMany('App\User')->withPivot('unities', 'type');
  }
  
  public function unities()
  {
    return $this->belongsToMany('App\Unity');
  }

  public function unitiesCourses()
  {
    return $this->belongsToMany('App\Unity');
  }

  public function tips()
  {
      return $this->hasMany('App\Tip')->where('visible', 1);
  }
  public function courseTest()
  {
      return $this->hasOne('App\CourseTest', 'course_id', 'id');
  }

  public function novedades()
  {
      return $this->hasMany('App\Novedad');
  }
  public function problems()
  {
      return $this->hasMany('App\Problem');
  }
  public function practices()
  {
      return $this->hasMany('App\Practice');
  }
  public function pendientes()
  {
      return $this->hasMany('App\Pendiente');
  }
  public function categorias()
  {
      return $this->belongsToMany('App\Categoria');
  }
  public function info()
  {
      return $this->hasOne('App\CourseInfo');
  }
  /**
   * Recibe user_id 
   * devuelve el promedio de ese usuario en el curso
   */
  public function promedio($user_id)
  {

      $unidadesApp = 0;
      $auxAcumulado = 0;
      foreach ($this->unities as $key => $unity) {
        $acumuladoUnidad = 0;
        $cantAprobados = 0;

        foreach ($unity->tps as $tp) {
          $sco = $tp->scoreAprobado($user_id)->take(1)->get();
          if (count($sco) != 0) {
            $acumuladoUnidad = $acumuladoUnidad + $sco[0]->nota_numerica;
            $cantAprobados++;
          }
        }
            
        foreach ($unity->tpsVf as $key => $value) {
          if ($value->score != null) {

            if ($value->score->nota > 7) {
              $acumuladoUnidad = $acumuladoUnidad + $value->score->nota;
              $cantAprobados++;
              
            }
          }
        }
            
        if ($cantAprobados != 0) {
      
          $unidadesApp++;
          $auxAcumulado = $auxAcumulado + ($acumuladoUnidad /$cantAprobados);
          
        }
          
      }
        if ($unidadesApp == 0) {
        
          $unidadesApp = 1;
        }
        
        $promedio = round(($auxAcumulado/ $unidadesApp),2);

        return $promedio;
   
  }

  public function recibido($user_id)
  {
      return $this->hasOne('App\Recibido')->where('user_id',$user_id)->first();
  }

  public function videoMuestra()
  {
      return $this->hasOne('App\VideoMuestra');
  }
}
