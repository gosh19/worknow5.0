<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursesData {


    public function getAll($withSelected =false)
    {
        $courses = \App\Course::all();

        if (!$withSelected && !session('courses')) {
            return $courses;
        }

        foreach ($courses as $key => $course) {
            $index = array_search($course->id,session('courses'));

            if ($index === false) {
                $course->selected = false;
            }else{
                $course->selected = true;
            }
        }
        return $courses;
    }
    public function getSelectedInSession()
    {
        $selected = (object) session('courses');
        return $selected;
    }

}