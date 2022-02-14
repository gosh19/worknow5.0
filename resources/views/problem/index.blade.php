@extends('layouts.app')

@section('content')
    <div class="alert alert-info">
        <h1>Panel de reparaciones</h1>
        <p>Aqui podras crear un <strong>paso a paso</strong> de una reparacion.</p>
        <a class="btn btn-primary" href="{{route('Problem.create')}}">Crear reparacion</a>
    </div>
    <table class="table">
        <thead>
            <th scope="row">Sintoma</th>
            <th scope="row">Descripcion</th>
            <th scope="row">Curso</th>
            <th scope="row">Imagen</th>
            <th scope="row">Cantidad de pasos</th>
            <th scope="row">Actions</th>
        </thead>
        <tbody>
            @foreach ($problems as $key => $problem)
                <tr>
                    <td>{{$problem->sintoma}}</td>
                    <td>{{$problem->descripcion}}</td>
                    <td>{{$problem->course->nombre ?? 'sin cargar'}}</td>
                    <td> <img width="100%" src="{{$problem->img}}" alt="" srcset=""> </td>
                    <td>
                        <div >

                            <p>{{count($problem->steps)}} </p>
                            <a class="btn btn-danger" href="{{route('Problem.showSteps',['Problem' => $problem])}}">Ver pasos</a>
                        </div>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{route('Problem.edit', ['Problem' => $problem])}}">Editar</a>
                        <a onclick="javascript: return confirm('Estas seguro que desea eliminar el paso a paso?')" class="btn btn-danger" href="{{route('Problem.eliminar',['id' => $problem->id])}}">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection