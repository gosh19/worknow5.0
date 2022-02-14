<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreTpVf extends Model
{
    protected $fillable = [
        'user_id', 'tp_id', 'nota'
    ];
}
