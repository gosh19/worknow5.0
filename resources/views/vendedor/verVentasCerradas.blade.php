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
        <a href="/ver-ventas-cerradas/{{$i}}" class="btn btn-primary">{{$mesArray[$i-1]}}</a>
    @endfor
  </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">email</th>
                <th scope="col">Tipo Pago</th>
                <th scope="col">Cursos</th>
                <th scope="col">Kit</th>
                <th scope="col">Estado</th>
                <th scope="col">Observacion</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($ventas as $venta)
            <tr>

                <th scope="row">{{$venta->id}}</th>
                <td>{{$venta['user']->name}}</td>
                <td>{{$venta['user']->email}}</td>
                <td>{{$venta['user']->tipo_pago}}</td>
                <td>
                    <ul>

                        @foreach ($venta->user->courses as $course)
                            <li>{{$course->nombre}}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    {{$venta->user->datosKit != null ? @$venta->user->datosKit->kitType->name:''}}
                </td>
                @if ($venta->alta)
                <td class="bg-success">Alta</td>
                @else
                <td class="bg-danger">Baja</td>   
                @endif
                <td>{{$venta->observacion}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection