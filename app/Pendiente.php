<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendiente extends Model
{
    protected $fillable= [
        'name', 'email', 'informativo', 'cupon','vendedor_id',
    ];

    public function course()
    {
        return $this->belongsTo('App\Course');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User', 'vendedor_id', 'id');
    }
}
