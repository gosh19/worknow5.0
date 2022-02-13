<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosPedido extends Model
{
    protected $fillable =[
        'carrito_id','estado'
    ];
    
    protected $primaryKey = 'carrito_id';
    
    public function carrito()
    {
        return $this->belongsTo('App\Carrito');
    }
}
