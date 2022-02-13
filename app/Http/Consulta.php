<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = [
        'user_id', 'consulta'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
