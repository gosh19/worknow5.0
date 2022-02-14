<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosUser extends Model
{
    protected $primaryKey = 'user_id';

    protected $fillable = [
      'user_id','name', 'dni', 'direccion', 'telefono', 'tarjeta'
    ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }
  public function estado()
  {
    return $this->hasOne('App\DatosUser', 'user_id');
  }
}
