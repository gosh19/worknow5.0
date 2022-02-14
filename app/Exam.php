<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Exam extends Model
{
  public function unity()
  {
      return $this->belongsTo('App\Unity');
  }

  public function scores()
  {
      return $this->hasMany('App\ScoreExam');
  }
  
  public function Tpresueltos()
  {
      return $this->hasMany('App\Tpresuelto');
  }

  public function questions()
  {
      return $this->hasMany('App\Question');
  }

  public function scoreExams()
  {
      $score = \App\ScoreExam::where([['user_id', Auth::user()->id],['exam_id',$this->id]])->first();

     

      if ($score == null) {
          return ['state' => true];
      }else{
          if ($score->nota == 'aprobado') {
            return ['state' => false, 'nota' =>$score->nota];
          }
        $resuelto = new Carbon($score->created_at);

        $resuelto->day = $resuelto->day+10;
        $resuelto = $resuelto->format('d-m-Y');
        $hoy = Carbon::now();
        $hoy = $hoy->format('d-m-Y');
        $hoy = strtotime($hoy);
        $fechaResolucion = strtotime($resuelto);

          if ($hoy >= $fechaResolucion) {
            return ['state' => true];
          }

          return ['state' => false, 'fecha' => $resuelto];
      }
  }



}
