<?php
namespace App\Http\Controllers;
use App\Tp;
use App\Tpresuelto;
use App\Score;
use App\User;
use Illuminate\Http\Request;

class TpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('habilitarTps', ['users' => $users]);
    }

    public function aprobar(Request $request)
    {
        
      $resuelto = new Tpresuelto;
      $resuelto->tp_id = $request['tp_id'];
      $resuelto->user_id = $request['user_id'];
      $resuelto->url = 'no entregado';
      $resuelto->save();

      if ($request->score_id == null) {
          $score = new Score;
          $score->user_id = $request['user_id'];
          $score->tp_id = $request['tp_id'];
      }else{
          $score = Score::find($request->score_id);
      }

      $score->nota_numerica = $request->nota_numerica;

      ($request->nota_numerica >= 7) ? $score->nota = 'aprobado' :$score->nota = 'desaprobado';
      

      $score->tpresuelto_id = $resuelto->id;
      $score->save();

      $unity = Tp::find( $request['tp_id'])->unity()->get();
      if ($unity != []) {
          $unity = $unity[0];
          $course = \App\Unity::find($unity->id)->courses()->get();
          if ($course != []) {
            $course = $course[0];
            $notification = \App\Notification::where([
                                                    ['user_id', $request->user_id],
                                                    ['unity_id',$unity->id],
                                                    ['course_id',$course->id]
                                                    ])->get();
            if (count($notification) == 0) {
                $notification = new \App\Notification;
                $notification->user_id = $request->user_id;
                $notification->tipo = "unidad";
                $notification->course_id = $course->id;
                $notification->unity_id = $unity->id;

            }else{
                $notification = $notification[0];
                $notification->visto = 0;    
            }
            $notification->save();
          }
      }

      return redirect()->back()->with($score->nota, 'success');
    }

    public function aprobarTps(Request $request){
      $userScores = User::find($request['id'])->TpresueltoUser();
      foreach ($userScores as $score) {
          echo $score;
      }
    }

    public function download(Request $request)
    {
        return response()->download(storage_path() . '/' . $request['url']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tp  $tp
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
         
        $tp = Tp::find($request['tp_id']);
        $scores = \App\Score::where('tp_id',$tp->id)->get();
        foreach ($scores as $key => $value) {
            $tpres = \App\Tpresuelto::find($value->tpresuelto_id);
            $value->delete();
            $tpres->delete();
            echo $key;
            }
            $tpres = \App\Tpresuelto::where('tp_id', $tp->id)->get();
        foreach ($tpres as $key => $value) {
            $value->delete();
        }
        $tp->delete();
        return redirect()->back();
    }

}
