@extends('layouts.app')

@section('content')
<div class="alert alert-info">
    <h1 class="text-3xl">Bienvenidos al foro</h1>
    <p>Aqui podras encontrar publicaciones de otros alumnos. Puedes crear tus propios posts 
        solo debes esperar a que un administrador lo apruebe.
    </p>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('foro.modal-create-post')
            <a class="btn btn-primary btn-block mb-3 font-weight-bolder" href="{{route('Foro.verNotificaciones')}}">Notificaciones <i class="fas fa-bell"></i></a>
            @if (Auth::user()->rol == 'admin')
                <a class="btn btn-danger btn-block font-weight-bolder" href="{{route('Foro.verNoHab')}}">Ver publicaciones no habilitadas <i class="fas fa-ghost"></i></a>
            @endif
            <hr>
            <ul class="list-group mb-3">
                <li class="list-group-item">Proximamente categorias</li>

            </ul>
        </div>
        <div class="col-md-9">
            <h2 class="text-3xl">Ultimas publicaciones</h2>
            <hr>
            @foreach ($posts as $key => $post)
                @livewire('foro.post',['post'=> $post], key($post->id + 2000))
            @endforeach

        </div>
    </div>
    
</div>
@endsection