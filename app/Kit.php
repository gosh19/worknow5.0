<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    protected $fillable = [
        'user_id', 'estado','comentario'
    ];

    public function user()
    {
        return $this->belongsTo('App\User')->with('datosUser');
    }

    public function kitType()
    {
        return $this->belongsTo('App\KitType');
    }
}
