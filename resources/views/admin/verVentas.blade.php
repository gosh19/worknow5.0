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
        <a href="/ver-ventas-mes/{{$i}}" class="btn btn-primary">{{$mesArray[$i-1]}}</a>
    @endfor
</div>
<div class="alert alert-info ml-3 mr-3 text-center">

  <h3 class=" font-weight-bolder">{{count($ventasMes)}} Ventas en {{$mesArray[$mes-1]}} </h3>
</div>
<hr class="mb-3">
<div class="flex justify-around">

  <button data-toggle="collapse" data-target="#cursos" class="bg-blue-600 text-white p-2">Ver cursos</button>
  <button data-toggle="collapse" data-target="#provincias" class="bg-red-600 text-white p-2">Ver Provincias</button>
  <button data-toggle="collapse" data-target="#vendedoras" class="bg-purple-600 text-white p-2">Ver Vendedoras</button>

</div>
<div class="flex flex-wrap collapse" id="cursos">
  @foreach ($valores as $key => $item)
      <div class="p-2 bg-red-500 font-bold w-40 mr-2 border-2 text-white border-black tracking-wider">
        <p>{{$key}} : <span class="text-xl">{{$item}}</span></p>
      </div>
  @endforeach
</div>
<hr class="mb-3">
<div class="flex flex-wrap collapse" id="provincias">
  @foreach ($provincias as $item)
      <div class="p-2 bg-blue-500 font-bold w-40 mr-2 border-2 text-white border-black tracking-wider">
        <p>{{$item['provincia']}} : <span class="text-xl">{{$item['cant']}}</span></p>
      </div>
  @endforeach
</div>
<hr class="mb-3">
<div class="flex flex-wrap collapse" id="vendedoras">
  @foreach ($vendedoras as $item)
      <div class="p-2 bg-purple-500 font-bold w-40 mr-2 border-2 text-white border-black tracking-wider">
        <p>{{$item['name']}} : <span class="text-xl">{{$item['cant']}}</span></p>
        <p>$ {{number_format($item['facturado'])}}</p>
      </div>
  @endforeach
</div>
<table class="table table-hover">
    <thead class="bg-info">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Vendedora</th>
        <th scope="col">Nombre Alumno</th>
        <th scope="col">Email Alumno</th>
        <th scope="col">Tipo Pago</th>
        <th scope="col">Kit</th>
        <th scope="col">Estado Kit</th>
        <th scope="col">Fecha</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($ventasMes as $indice => $venta)  
      
      <tr>
        
        <th scope="row">{{$venta->datosAlumno['id']}}</th>
        <td>{{$venta->datosVendedor['name']}}</td>
        <td>{{$venta->datosAlumno['name']}}</td>
        <td><a href={{ route('User.modificarAlumno', ['id'=>$venta->alumno]) }}>{{$venta->datosAlumno['email']}}</a></td>
        <td>{{$venta->datosAlumno['tipo_pago']}}</td>
        @if ($venta->datosAlumno['kit'])
            <td class="bg-success">si</td>
        @else
            <td class="bg-danger">no</td>
        @endif
        <td>{{$venta->datosAlumno->datosKit->estado ?? ''}} </td>
        <td>{{$venta->fecha}}</td>
      </tr>      

      @endforeach
    </tbody>
  </table>
@endsection