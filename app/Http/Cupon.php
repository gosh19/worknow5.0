<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $fillable = [
        'name', 'monto', 'url'
    ];

    public function vendedora()
    {
        return $this->belongsTo('App\User', 'vendedor', 'id');
    }
}
