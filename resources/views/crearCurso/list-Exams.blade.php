@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
            <th>Curso</th>
            <th>Unidad</th>
            <th>---</th>
        </thead>
        <tbody>
            @foreach ($exams as $exam)
                @if (($exam->unity != null) && (count($exam->unity->courses) != 0))
                    
                <tr>
                    <td>{{$exam->unity->courses[0]->nombre}}</td>
                    <td>{{$exam->unity->nombre}}</td>
                    <td><a class="btn btn-danger" href={{route('Exam.editExam',['id'=> $exam->id])}}>Ver</a></td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endsection