<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseTest extends Model
{
    protected $primaryKey = 'course_id';
    
    public function course()
    {
        return $this->belongsTo('App\Course', 'course_id', 'id');
    }
}
