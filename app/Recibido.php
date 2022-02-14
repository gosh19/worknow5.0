<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibido extends Model
{
    protected $fillable = [
        'user_id', 'course_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
