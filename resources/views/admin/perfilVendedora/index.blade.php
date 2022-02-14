@extends('layouts.app')

@section('content')
@php
$mesArray= array(
    'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
    'Julio',
    'Agosto',
    'Septiembre',
    'Octubre',
    'Noviembre',
    'Diciembre'
)
@endphp

<div class="d-flex justify-content-around mb-3">

    @for($i = 1; $i <13; $i++)
        <a href={{"/show-vendedora/".$vendedora->id."/".$i}} class="btn btn-primary">{{$mesArray[$i-1]}}</a>
    @endfor
</div>
<hr>
<div class="container-fluid">
    <div class="row">
      <div class="col-md-4">
        
        <div class="card bg-primary">
          <div class="card-header text-white font-weight-bolder">
            Datos Vendedora
          </div>
          <ul class="list-group">
            <li class="list-group-item"><b>Nombre : </b>{{$vendedora->name}}</li>
            <li class="list-group-item"><b>E-mail : </b>{{$vendedora->email}}</li>
            <li class="list-group-item"><b>Rendimiento : </b>{{$vendedora->rendimiento($mes)}}</li>
            <li class="list-group-item"><b>Comision : </b>{{$vendedora->comision}}</li>
            {{--
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <p>

                        <b>Puntos : </b>{{$vendedora->puntosMes($mes)}}
                    </p>
                    <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#collapsePuntos" aria-expanded="false" aria-controls="collapseExample">
                        +
                    </button>
                </div>
            </li>
            --}}
            <ul class="list-group collapse border border-primary" id="collapsePuntos">
                <li class="list-group-item"><b>Credito : </b>{{$vendedora->cantVentaXTipo('credito',$mes)}}</li>
                <li class="list-group-item"><b>Efectivo Total : </b>{{$vendedora->cantVentaXTipo('efectivoTotal',$mes)}}</li>
                <li class="list-group-item"><b>Efectivo : </b>{{$vendedora->cantVentaXTipo('efectivo',$mes)}}</li>
                <li class="list-group-item"><b>Kits : </b>{{$vendedora->cantVentaXTipo('kit',$mes)}}</li>
                <li class="list-group-item"><b>Uy : </b>{{$vendedora->cantVentaXTipo('UY',$mes)}}</li>
            </ul>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                        <b>Ingresos</b>
                    <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#collapseIngresos" aria-expanded="false" aria-controls="collapseExample">
                        +
                    </button>
                </div>
            </li>
            <ul class="list-group collapse border border-primary" id="collapseIngresos">
                @foreach ($vendedora->IngresosMes($mes)->get() as $ing)
                    
                <li class="list-group-item text-center"><b>{{date_format($ing->created_at,'d-m')}} : </b>{{date_format($ing->created_at,'H:i')}}</li>
                @endforeach
            </ul>
          </ul>
        </div>
        <div class="d-flex justify-content-center mt-3 ">
            <img width="200px" src="{{ asset('img/cohete.jpg') }}" alt="">
        </div>
      </div>
      <div class="col-md-8">
          <div class="card text-white bg-dark">
            <div class="card-header">
                Ventas del mes de {{$mesArray[$mes-1]}} = {{count($vendedora->ventasCerradasMes($mes)->get())}}
            </div>
            <div class="card-body">
                <div class="accordion" id="accordionExample">
                    @foreach ($vendedora->ventasCerradasMes($mes)->get() as $venta)
                        <div class="card">
                            <div class="card-header bg-{{$venta->alta ? "success":"danger"}}" id="headingOne">
                                <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left text-white font-weight-bolder" type="button" data-toggle="collapse" data-target="#collapse-{{$venta->id}}">
                                    {{$venta->datosAlumno->name}}
                                    
                                </button>
                                </h2>
                            </div>
                        
                            <div id="collapse-{{$venta->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <a href="{{route('User.modificarAlumno',['id' => $venta->datosAlumno->id])}}" 
                                    class="btn btn-dark btn-block mt-3"
                                    target="_blank"
                                > Ir al perfil</a>
                                <div class="card-body">
                                    <table class="table  bg-light">
                                        <thead>
                                            <th scope="row">ID</th>
                                            <th scope="row">Nombre</th>
                                            <th scope="row">E-mail</th>
                                            <th scope="row">Tipo Pago</th>
                                            <th scope="row">Tarjeta</th>
                                            <th scope="row">Kit</th>
                                            <th scope="row">Info</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$venta->datosAlumno->id}}</td>
                                                <td>{{$venta->datosAlumno->name}}</td>
                                                <td>{{$venta->datosAlumno->email}}</td>
                                                <td>{{$venta->datosAlumno->tipo_pago}}</td>
                                                <td>{{$venta->datosUser->tarjeta ?? "sin cargar"}}</td>
                                                <td>{{$venta->datosAlumno->kit? 'SI':'NO'}}</td>
                                                @if ($venta->datosAlumno->infoKit != null)
                                                    <td>{{$venta->datosAlumno->infoKit->estado}}</td>
                                                @endif
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                    @include('admin.modificarAlumno.cajaCobranza',['user' => $venta->datosAlumno])
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
          </div>
      </div>
    </div>
</div>


@endsection