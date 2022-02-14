@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-10">
      <div class="alert alert-info">

        <h1 class="text-3xl">Work Now News</h1>
        <p>
          Aqui podras ver las ultimas novedades referentes al area en la que estas trabajando. 
          En caso que veas alguna nota en tu diario local pasalo a tu profesor a cargo para que podamos 
          revisarlo y compartirlo con los demas alumnos. 
        </p>
      </div>
    </div>
    <div class="col-2">
      <img src="{{asset('img/lupa.jpg')}}" alt="Avatar-Lupa" width="100%">
    </div>
  </div>

  @if (Auth::user()->rol == "admin")
      
    <a href="{{route('Novedad.crear')}}" class="btn btn-info">Cargar nueva</a>
  @endif

  <hr class="mb-3">

<div class="row">

  <div class="col-md-3">
    <div class="card">
      <ul class="list-group">
        @foreach ($courses as $course)
            @if (count($course->novedades) != 0)
                
            <li class="list-group-item">
              <a class="font-bold text-blue-700" href="{{route('Novedad.index',['id' => $course->id])}}"><i class="fas fa-sign-in-alt"></i>&nbsp;{{$course->nombre}}</a>
            </li>
            @endif
        @endforeach
      </ul>
    </div>
  </div>
  <div class="col-md-9">
@php
    $index = 1;
@endphp
    @foreach ($novedades as $novedad)
    @if ($index)
        @php
            $index = 0;
            $theme = 'danger';
        @endphp
    @else
      @php
        $index = 1;
        $theme = 'primary';
      @endphp
    @endif

    <div class="border border-{{$theme}} rounded p-3 mt-3">

      <h1 class="text-{{$theme}} text-3xl mb-2">{{$novedad->titulo}}</h1>
      <h5 class="text-1xl mb-2">{{$novedad->subtitulo}}</h5>
      <hr>
      <a class="btn btn-{{$theme}} btn-block" target="_blank" href="{{$novedad->url}}">Ir a la Noticia</a>
      @if (Auth::user()->rol == "admin")
          
      <a class="btn btn-warning mt-3" href="{{route('Novedad.edit',['Novedad' => $novedad])}}">Editar</a>
      <a onclick="javascript:return confirm('Estas seguro que deseas eliminar la novedad?');" class="btn btn-danger mt-3" href="{{route('Novedad.eliminar',['novedad' => $novedad])}}">Eliminar</a>
      @endif
    </div>
    @endforeach
  </div>
</div>







</div>

@endsection
