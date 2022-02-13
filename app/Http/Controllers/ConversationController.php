<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ConverPractice;

class ConversationController extends Controller
{
    public function loadMsj(Request $request, $practice_id,$user_id=null)
    {
        if ($user_id == null) {
            $user_id = Auth::user()->id;
        }
        $conversation = ConverPractice::firstOrCreate(['user_id'=> $user_id,'practice_id' => $practice_id ]);

        if ($conversation->admin) {
            $conversation->admin = false;
            $conversation->save(); 
        }
        $answer = new \App\AnswerPractice;

        $answer->conver_practice_id = $conversation->id;
        $answer->user_id = Auth::user()->id;
        $answer->msj = $request->msj;

        $answer->save();

        if ($request->has('img')) {
            $img = new \App\ResourceAnswerPractice;
    
            $img->answer_practice_id = $answer->id;
            $file = $request->img;
            $name = $file->store('practice/'.$conversation->practice->id.'/conversation-'.$conversation->id, 'public');
            $img->url = '/storage/'. $name;
            $img->save();
        }

        return redirect()->back();
    }

    public function loadMsjAdmin(Type $var = null)
    {
        # code...
    }
}
