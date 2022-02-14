<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
  public function unity()
  {
      return $this->belongsTo('App\Unity');
  }
}
