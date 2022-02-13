<?php

namespace App\Http\Controllers;

use App\Exam;
use App\ScoreExam;
use App\Unity;
use App\Answer;
use App\Question;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $questions = Exam::find($request['exam_id'])->questions()->with('answers')->get();
        $unity_id = $request['unity_id'];

        return view('exam', ['questions' => $questions, 'unity_id' => $unity_id]);
    }

    public function verExams()
    {
      $exams = Exam::all();

      return view('crearCurso.list-Exams', ['exams' => $exams]);
    }

    public function editExam($id)
    {
      $exam = Exam::find($id);

      $exam->question;

      return view('crearCurso.edit-exam',['exam' => $exam]);
    }

    public function verify(Request $request){

      $examen = new Exam;
      $examen->numero = 1;
      $examen->unity_id = $request['unity_id'];
      $examen->user_id = $request['user_id'];
      $examen->save();

      return view('exam');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $cursos = Course::with('unities')->get();
        return view('crearCurso.crearExam',['cursos' => $cursos ]);
    }
    public function cargarEx(Request $request)
    {
      $unidad = Unity::find($request['unidad_id']);
      $unidad->cant_ev++;
      $unidad->save();

      $examen = new Exam;
      $examen->unity_id = $request['unidad_id'];
      //ME FIJO Q NUMERO DE EXAMEN ES Y LE SUMO UNO PARA Q SEA EL SIGUIENTE
      $aux = Exam::where('unity_id', '=', $request['unidad_id'])->orderBy('DESC')->take(1);
      if(isset($aux->numero)){
        $aux->numero++;
      }
      else{
        $aux->numero = 1;
      }
      $examen->numero = $aux->numero;
      $examen->save();
      $i=0;
      foreach ($request['question'] as $q) {

        $question = new Question;
        $question->exam_id = $examen->id;
        $question->pregunta= $q;
        $question->save();
        $correcta=1;
        foreach ($request['answer'][$i] as $ans) {

            $answer = new Answer;
            $answer->question_id = $question->id;
            $answer->answer = $ans;
            if ($correcta == $request['correcta'][$i]) {
              $answer->estado = 1;
            }
            else {
              $answer->estado = 0;
            }
            $answer->save();
            $correcta++;
        }
        $i++;

      }

      return redirect('/');;

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $correctas = 0;

        for($i = 0; $i<count($request['correcta']); $i++){
          $respuesta = Answer::find($request['correcta'][$i]);
          if($respuesta->estado == 1){
            $correctas++;
          }
        }

        $promedio = ($correctas*100) / $i; //SACAMOS EL PROMEDIO DE APROBADAS Y DESAPROBADAS

        $scoreExams = ScoreExam::where([['user_id', Auth::user()->id],['exam_id', $request->exam_id]])->get();
        $exist = 0;

        foreach ($scoreExams as $score) {
          $score->delete();
        }

        $exam_user = new ScoreExam;
        $exam_user->exam_id = $request['exam_id'];
        $exam_user->user_id = $request['user_id'];


        if($promedio >= 70){ // SI DA MAS QUE 70 APROBADO
              $exam_user->nota = 'aprobado';
        }else{
              $exam_user->nota = 'desaprobado';
        }
            
            $exam_user->save();

        for($i = 0; $i<count($request['correcta']); $i++){
          $answers[$i] = Answer::find($request['correcta'][$i]);
        }

        $questions = Exam::find($request['exam_id'])->questions()->with('answers')->get();
        $unity_id = $request['unity_id'];

        //PASAMOS A LA PAGINA RESULTADO LAS RESPUESTAS ELEGIDAS Y LUEGO PASAMOS TODAS LAS PREGUNTAS Y RESPUESTAS.

        return view('resultado',[
                                'notaTotal' => $promedio,
                                'answers' => $answers,
                                'questions' => $questions,
                                'unity_id' => $unity_id]);
    }

}
