<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoMuestra extends Model
{
    public $primaryKey = 'course_id';
    
    protected $fillable = [
        'course_id','url'
    ];
}
