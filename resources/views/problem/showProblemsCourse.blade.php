@extends('layouts.app')

@section('content')
<a class="btn btn-primary ml-3" href="/VerCurso/{{$course->id}}">Volver</a>
    <div class="container">
        <div class="row justify-content-center">
            <img width="200px" src="{{ asset('img/lupa.jpg') }}" alt="" srcset="">
        </div>
        <div class="row justify-content-center">
            <div class="alert alert-dark text-center">
                <p>Cada reparacion/procedimiento esta explicado <b> paso a paso.</b> En caso de no encontrar lo que buscabas, <br>
                    dejanos tu sugerencia/pedido por whastapp hablando con tu profesor a cargo o en <br> <a class="btn btn-primary" href="/faq-view">esta seccion</a>
                </p>
            </div>
        </div>
        <div class="row">
            @if (count($course->problems) != 0)
            @php
                $theme = 'primary';
            @endphp
            <div class="accordion w-100" id="accordionExample">
            @foreach ($course->problems as $problem)
                
            <div class="col p-3">
                <div class="card">
                    <div id="heading{{$problem->id}}" class="card-header bg-{{$theme}} text-white" style="font-size: 17px">
                       
                       <button class="btn btn-link btn-block text-left text-white" 
                                type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapse-{{$problem->id}}" 
                                aria-expanded="true" 
                                aria-controls="collapse-{{$problem->id}}"
                        >
                        <div class="d-flex justify-content-between">
                            <h5 class="text-1xl">Sintoma : <strong > {{$problem->sintoma}}</strong></h5>
                            <h5 class="badge badge-dark">+</h5>
                            
                        </div>
                      </button>
                    </div>
                    <div id="collapse-{{$problem->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <p class="mb-3">{{$problem->descripcion}}</p>
                            <hr class="mb-3">
                            <div class="d-flex justify-content-center">

                                <a class="btn btn-{{$theme}}" href="{{route('Problem.showProblemUser',['Problem' => $problem])}}">Ver solucion</a>
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