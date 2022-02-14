@extends('layouts.app')

@section('content')
<a class="btn btn-primary" href="{{route('Problem.showProblems',['Course'=> $problem->course])}}">Volver</a>
    <div class="container mt-3">
        <h1 class="text-primary text-2xl mb-3">{{$problem->sintoma}}</h1>
        <hr class="mb-3">
        <h5 class="text-1xl mb-3">{{$problem->descripcion}}</h5>
        <hr>
        @php
            $theme = 'primary';
        @endphp
        @foreach ($problem->steps as $index => $step)
        @php
            if($theme == 'primary'){
                $theme = 'info';
            }else{
                $theme = 'primary';
            }
        @endphp
            <div class="row p-3 bg-{{$theme}} rounded mb-3">
                <div class="col-md-5 ">
                    <h5 class="font-weight-bold">Paso {{$step->numero}} :</h5>
                    <div class="border border-dark bg-fondo-conf rounded p-3 mb-3">{{$step->descripcion}}</div>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        @if (count($step->imgStep) != 0)
                            
                            @foreach ($step->imgStep as $index => $img)
                            <div class="col-6">
                                <img width="100%" src="{{$img->url}}" alt="" srcset="">
                            </div>
                            @endforeach
                        @else
                        
                            <div class="alert alert-info">
                                No hay imagenes disponibles
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
    </div>
@endsection