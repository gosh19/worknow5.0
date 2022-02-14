@extends('layouts.app')

@section('content')
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="row">#</th>
                <th scope="row">Usuario</th>
                <th scope="row">Consulta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($consultas as $consulta)
                <tr>
                    <td scope="row">{{$consulta->id}}</td>
                    <td>{{$consulta->user->name}}</td>
                    <td>{{$consulta->consulta}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection