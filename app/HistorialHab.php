<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialHab extends Model
{
    protected $fillable = [
        'user_id','admin','case'
    ];
}
