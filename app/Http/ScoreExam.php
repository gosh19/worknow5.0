<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreExam extends Model
{
  public function exams()
  {
    return $this->belongsTo('App\Exam');
  }

}
