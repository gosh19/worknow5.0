<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursesData {


    public function getAll()
    {
        $courses = \App\Course::all();

        return $courses;
    }

}