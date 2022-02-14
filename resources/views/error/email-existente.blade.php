@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
    <div class="alert alert-danger">
        <h3>Error</h3>
        <h5>Correo <strong> {{$user->email}}</strong> ya registrado</h5>
        <ul>
            <li>ID: {{$user->id}} </li>
            <li>Nombre: {{$user->name}} </li>
        </ul>
        <div class="d-flex justify-content-between">

            <a class="btn btn-success" href="/modificarAlumno?id={{$user->id}}">Ir al perfil</a>
            <a class="btn btn-danger" href="/modificarAlumno?id={{$id}}">Volver</a>
        </div>

    </div>
</div>
    
@endsection