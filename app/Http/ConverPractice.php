<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConverPractice extends Model
{
    protected $fillable = [
        'user_id','practice_id'
    ];

    public function practice()
    {
        return $this->belongsTo('App\Practice');
    }
    public function answers()
    {
        return $this->hasMany('App\AnswerPractice')->orderBy('id','desc');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
