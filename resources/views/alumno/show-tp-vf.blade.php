@extends('layouts.app')

@section('content')
<div class="alert alert-info">
    <h5>Trabajo practico Verdadero/Falso</h5>
    <p>Lea atentamente cada afirmacion y en seleccione segun corresponda</p>
    <a class="btn btn-danger" href="{{route('Unidad.index',['id'=>$tp->unity->id])}}">Volver</a>
</div>
<div class="container-fluid">


@if (isset($data))
    @if ($data == 1)
        <div class="alert alert-danger d-flex justify-content-center">
            <p class="mr-3">Trabajo practico ya aprobado</p>
            
        </div>
    @else
        @if ($nota <7)
        <div class="alert alert-danger d-flex justify-content-center">
            <p class="mr-3">Nota : {{$nota}} - <strong>Desaprobado</strong> </p>
            
        </div>
        @else
        <div class="alert alert-success d-flex justify-content-center">
            <p class="mr-3">Nota : {{$nota}} - <strong>Aprobado</strong> </p>
            
        </div>
        @endif
        <hr class="border border-primary">
        @foreach ($tp->afirmations as $index => $af)
            <div class="row">
                <div class="col w-100">
                    <div class="alert alert-info">
                        <h3>Afirmacion {{$index + 1}} :</h3>
                        <hr>
                        <p style="font-size: 20px;">{{$af->afirmation}}</p>
                    </div>
                </div>
            </div>
            @if (!isset($data[$af->id]))
                <div class="alert alert-danger d-flex justify-content-between">
                    <h3>Sin responder</h3>
                    <p>
                        <b>Respuesta correcta :</b> {{($af->true) ? 'Verdadero' : 'Falso'}}
                    </p>
                </div>
            @else

                @if ((($af->true) && ($data[$af->id]  == 'on')) || ((!$af->true) && ($data[$af->id]  == 'off')))
                    <div class="alert alert-success d-flex justify-content-between">
                        <h3>Correcto</h3>
                    </div>
                @else
                    <div class="alert alert-danger d-flex justify-content-between">
                        <h3>Incorrecto</h3>
                    </div>
                @endif
                <div class="border p-3 m-3">

                    <ul>
                        {{$data[$af->id]}}

                        <li><b> Eleccion del alumno :</b> {{($data[$af->id] == 'on') ? 'Verdadero' : 'Falso'}}</li>
                        <li><b>Respuesta correcta :</b> {{($af->true) ? 'Verdadero' : 'Falso'}}</li>
                    </ul>
                </div>

            @endif
            <hr class="border border-dark">
        @endforeach
    @endif
    
@else 

    <form action="{{route('Score.CorrectionTpVf',['tp_id' => $tp->id])}}" method="post">
        @csrf
        @foreach ($tpDes as $af)
        <div class="alert alert-primary d-flex justify-content-between">
            <div class="row w-100 justify-content-between">
                <div class="col-md-9 ">

                    <p style="font-size: 20px;">{{$af->afirmation}}</p>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <div class="d-flex justify-content-center">
                        <div class="mr-4 p-3 bg-success rounded">
                            <div class="">
                                <h5 class="text-white" >Verdadero</h5>
                                <div class="d-flex justify-content-center">

                                    <input class="mt-2" type="radio" name="afirmation[{{$af->id}}]" value='on'>
                                </div>
                            </div>
                        </div>
                        <div class="mr-4 p-3 bg-danger rounded">
                            <div class="">
                                <h5 class="text-white" >Falso</h5>
                                <div class="d-flex justify-content-center">

                                    <input class="mt-2" type="radio" name="afirmation[{{$af->id}}]" value='off'>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
  
        <div class="d-flex justify-content-end mr-5 ml-5">
            <input type="submit" class="btn btn-danger btn-block " value="Terminar">
        </div>
    </form>
@endif

</div>
@endsection