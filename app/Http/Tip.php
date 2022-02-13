<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    protected $fillable = [
        'texto', 'course_id', 'visible'
    ];

    public function curso()
    {
        return $this->belongsTo('App\Course', 'course_id', 'id');
    }
}
