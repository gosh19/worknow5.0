@extends('layouts.app') 

@section('content')
<livewire:perfil-alumno.star >
    <form action="{{route('Cobranza.verVentasRango')}}" method="post">
        @csrf
        <div class="d-flex justify-content-around">
            <div>

                <label for="desde">Desde:</label>
                <input type="date" name="desde" id="desde" required>
            </div>
            <div>

                <label for="hasta">Hasta:</label>
                <input type="date" name="hasta" id="hasta" required>
            </div>
        </div>
        <div class="row justify-content-center">

            <input type="submit" value="Consultar" class="btn btn-primary ">
        </div>
    </form>
    <hr>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <b>Ventas totales :</b> {{count($ventas)}}
                        </li>
                        <li class="list-group-item">
                            <div class="row">

                                <div class="col-6">
                                    
                                    <b>Dinero total :</b> $ {{number_format($total)}}
                                </div>
                                <div class="col-6">
                                    <b>Promedio :</b> $ {{$promedio}}
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <hr class="my-3">
                <div>
                    <table class="table-fixed">
                        <thead class="bg-red-800 text-white text-xl">
                            <tr>
                                <th class="w-1/3 pl-2">Nombre</th>
                                <th class="w-2/3 pl-2">Cursos</th>
                            </tr>
                        </thead>
                        <tbody class="font-bold">
                            @php
                                $i=0;
                            @endphp
                            @foreach ($operarios as $op)
                                @foreach ($op->cant as  $item)
                                @php
                                    $valor = $i%2;
                                    $i++;
                                @endphp
                                @if ($valor ==0)
                                    <tr class="bg-red-200 text-black">
                                @else
                                    <tr class="bg-red-700 text-white">
                                @endif
                                        <td class="border-2 text-center"><i class="fas fa-graduation-cap"></i>{{$item->datosAlumno->name}}</td>
                                        <td class="border-2 text-center py-2">
                                            @foreach ($item->datosAlumno->courses as $course)
                                                {{$course->nombre}}   <br>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <ul class="list-group">
                        @foreach ($operarios as $op)
                            @if (count($op->cant) != 0)
                                
                                <li class="list-group-item">
                                    <b>{{$op->name}} :</b> {{count($op->cant)}} venta(s)
                                    @livewire('historia.vendedor-data', ['vendedor' => $op->id, 'ventas'=>$op->cant], key($op->id))
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection