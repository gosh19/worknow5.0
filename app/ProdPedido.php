<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdPedido extends Model
{
    protected $fillable = [
        'carrito_id', 'product_id'
    ];


    public function carrito()
    {
        return $this->belongsTo('App\Carrito');
    }
}
