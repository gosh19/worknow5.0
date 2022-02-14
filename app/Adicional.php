<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adicional extends Model
{
    protected $fillable = [
        'valor','cant_cuotas','denominacion',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
