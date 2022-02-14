<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
      'titulo', 'url', 'unity_id',
    ];

    public function unities()
  {
      return $this->belongsToMany('App\Unity');
  }

}
