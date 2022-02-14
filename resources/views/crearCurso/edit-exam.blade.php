@extends('layouts.app')

@section('content')

<div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text bg-success" id="basic-addon1">Pregunta nueva: </span>
    </div>
    
    <form action={{route('Question.editQuestion')}} method="post">
        @csrf
        <div class="d-flex justify-content-between">
        <input type="text" size="130" class="form-control" name="question" placeholder="Pregunta">
        <input type="hidden" name="exam_id" value="{{$exam->id}}" >
        <input class="btn btn-success ml-2" type="submit" value="Cargar">
    </div>
        </form>
  </div>

    @foreach ($exam->questions as $index => $question )
        
        <div class="card">
            <div class="card-header bg-info">
               <small> Pregunta N°{{$index+1}}</small>
               <form action={{route('Question.editQuestion')}} method="post">
                @csrf
                    <input type="hidden" name="id" value="{{$question->id}}">
                    <input type="text" size="130" name="question" value="{{$question->pregunta}}">
                    <input class="btn btn-success" type="submit" value="modificar">
                    <a class="btn btn-danger" href="{{route('Question.delete', ['id' => $question->id])}}">Eliminar</a>
                </form>
            </div>
            <ul class="list-group list-group-flush">
                <form method="POST" action={{route('Answer.editAnswer')}} >
                    <input type="hidden" name="question_id" value="{{$question->id}}">
                @for ($i = 0; $i < 3; $i++)    
                    @csrf
                    <li class="list-group-item">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input name="estado" 
                                            type="radio" 
                                            value="{{$question->answers[$i]->id ?? (-1*($i+1))}}"

                                    @if ($question->answers[$i]->estado ?? false)
                                    checked
                                    @endif
                                    >
                                </div>
                            </div>
                            <input name="answer[{{$question->answers[$i]->id ?? (-1*($i+1))}}]" type="text" class="form-control" value="{{$question->answers[$i]->answer ?? '-'}}" >
                        </li>
                    </div>
                    @endfor
                    <input class="btn btn-danger d-flex justify-content-end" type="submit" value="Cargar">
                </form>
            </ul>
        </div>
    @endforeach

@endsection