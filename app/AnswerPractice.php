<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerPractice extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function isAdmin()
    {
        if ($this->user->rol == 'admin') {
            return true;
        }
        return false;
    }
    public function conversation()
    {
        return $this->belongsTo('App\ConverPractice');
    }
    public function img()
    {
        return $this->hasOne('App\ResourceAnswerPractice');
    }
}
