<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    public function editQuestion(Request $request)
    {
        if ($request->id == null) {
            $question = new Question;
            $question->exam_id = $request->exam_id;
        }else{
            $question = Question::find($request->id);
        }
        $question->pregunta = $request->question;
        $question->save();

        return redirect()->back();
    }

    public function delete($id)
    {
        $question = Question::find($id);

        $question->delete();

        return redirect()->back();
    }
}
