<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $primaryKey = 'user_id';
    
    protected $fillable = [
        'user_id', 'visto'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
