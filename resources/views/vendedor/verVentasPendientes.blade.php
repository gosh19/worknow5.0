@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">email</th>
                <th scope="col">Ver</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td><a href="alumno-pendiente/{{$user->id}}"><button class="btn btn-primary">Ver</button></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection