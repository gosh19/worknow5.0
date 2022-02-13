<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;
use App\CourseTest;

class CourseTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();

        return view('courseTest.index',['courses' => $courses]);
    }

    public function modificar($case, $id)
    {
        if ($case == 'add') {
            $test = new CourseTest;
            $test->course_id = $id;
            $test->save();
        }else{
            $test = CourseTest::find($id);
            $test->delete();
        }
        return redirect()->back();
    }

    public function editCantUnities($id, Request $request)
    {
        $test = CourseTest::find($id);
        $test->unities = $request->cant_unities;
        $test->save();

        return redirect()->back();
    }

}
