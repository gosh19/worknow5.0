@extends('layouts.app')

@section('desarrollo')
  <div class="container">
    <div class="card">
      <div class="card-header bg-danger text-white font-weight-bolder">
        Desarrollo
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><a href={{ route('Novedad.index') }} >Novedades</a></li>
        <li class="list-group-item"><a href={{ route('Problem.index') }} >Reparaciones paso a paso</a></li>
        <li class="list-group-item"><a href={{ route('Practice.index') }} >Practicas</a><span class="badge badge-danger">New</span> </li>
        <li class="list-group-item"><a href="{{ route('Crearcurso')}}">Crear Curso</a></li>
        <li class="list-group-item"><a href="{{ route ('Unidad.create')}}">Crear Unidad</a></li>
        <li class="list-group-item"><a href="{{ route ('Exam.create')}}">Crear Examen</a></li>
        <li class="list-group-item"><a href="{{ route ('Exam.verExams')}}">Ver todos los examenes</a></li>
        <li class="list-group-item"><a href="{{ route ('Unidad.verUnidades')}}">Ver Unidades</a></li>
        <li class="list-group-item"><a href="{{route ('Curso.verCursos')}}">Ver Cursos</a></li>
        <li class="list-group-item"><a href="{{route ('Video.index')}}">Agregar Video</a></li>
        <li class="list-group-item"><a href="{{route ('VideosYT.create')}}">Agregar Video YouTube</a></li>
        <li class="list-group-item"><a href="{{route ('VideosYT.index')}}">Ver todos los videos de YouTube cargados</a></li>
        <li class="list-group-item"><a href={{ route('Tip.index') }} >Tips</a></li>
      </ul>
    </div>
  </div>
@endsection
