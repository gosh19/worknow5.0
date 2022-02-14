@extends('layouts.app')

@section('content')
    <div class="alert alert-info">
        <p>
            Los cursos en modalidad test solo tendran habilitadas las unidades que selecciones.
        </p>
        <p>Por defecto solo podran ver la primera, no podran entregar trabajos practicoss.</p>
    </div>
    <table class="table">
        <thead>
            <th scope="row">Nombre</th>
            <th scope="row">cant. Unidades</th>
            <th scope="row">Unidades disponibles</th>
            <th scope="row">Action</th>
        </thead>
        <tbody>
            @foreach ($courses as $curso)
                <tr>
                    <td>{{$curso->nombre}}</td>
                    <td>{{count($curso->unities)}} </td>
                    
                    @if ($curso->courseTest != null)

                    <td>{{$curso->courseTest->unities}} 
                        <form action="{{route('CourseTest.editCantUnities', ['id'=> $curso->id])}} " method="POST">
                            @csrf
                            <select name="cant_unities">
                                @foreach ($curso->unities as $index => $unity)
                                <option value="{{$index+1}}">{{$index+1}}</option>
                                @endforeach
                            </select>
                            <input type="submit" class="btn btn-warning" value="Modificar">
                        </form>
                    </td>
                    <td><a href={{route('CourseTest.modificar',['case'=> 'delete', 'id' => $curso->id ])}} class="btn btn-danger">Quitar</a> </td>
                    @else
                    <td></td>
                    <td><a href={{route('CourseTest.modificar',['case'=> 'add', 'id' => $curso->id ])}} class="btn btn-success">Agregar</a> </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection