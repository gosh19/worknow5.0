<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $fillable = [
        'user_id', 'estado'
    ];

    public function prodPedidos()
    {
        return $this->hasMany('App\ProdPedido');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function datosPedido()
    {
        return $this->hasOne('App\DatosPedido');
    }
}
