<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id','opcion',
    ];
}
