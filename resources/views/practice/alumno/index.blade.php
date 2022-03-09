@extends('layouts.app')

@section('content')
<a class="btn btn-primary ml-3" href="/VerCurso/{{$course->id}}">Volver</a>
    <div class="container">
        <div class="row justify-content-center mb-3">
            <img width="160px" src="{{ asset('img/herramientas.png') }}" alt="" srcset="">
        </div>
        <div class="row justify-content-center">
            <div class="alert alert-dark text-center">
                <p>
                    Cada practica esta explicada <b> paso a paso.</b> Recuerda realizar entregas parciales en caso que te trabes
                </p>
            </div>
        </div>
        <div class="row">
            @if (count($course->practices) != 0)
            @php
                $theme = 'primary';
            @endphp
            <div class="accordion w-100" id="accordionExample">
            @foreach ($course->practices as $practice)
                
            <div class="col p-3">
                <div class="card">
                    <div id="heading{{$practice->id}}" class="card-header bg-{{$theme}} text-white" style="font-size: 17px">
                       
                       <button class="btn btn-link btn-block text-left text-white" 
                                type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapse-{{$practice->id}}" 
                                aria-expanded="true" 
                                aria-controls="collapse-{{$practice->id}}"
                        >
                        <div class="d-flex justify-content-between">
                            <h5 class="text-1xl"><strong > {{$practice->titulo}}</strong></h5>
                            <h5 class="badge badge-dark">+</h5>
                            
                        </div>
                      </button>
                    </div>
                    <div id="collapse-{{$practice->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-3">{{$practice->desc}}</p>
                            <hr class="mb-3">
                            <div class="d-flex justify-content-center">

                                <a class="btn btn-{{$theme}}" href="{{route('Practice.showPracticeUser',['Practice' => $practice])}}">Ingresar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php
                if ($theme == 'primary') {
                    $theme = 'danger';
                }else{
                    $theme = 'primary';
                }
            @endphp
            @endforeach
            @else
                <div class="alert alert-danger">
                    <p>No hay fallas comunes disponibles</p>
                </div>
            @endif
        </div>
    </div>
@endsection