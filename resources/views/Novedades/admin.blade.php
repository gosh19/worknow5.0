@extends('layouts.app')

@section('content')

  @if (session('cargado')=='ok')
    <div class="alert alert-success">
      <p>Cargado con exito</p>
    </div>
  @endif

<div class="container">
  <form action="{{route ('Novedad.store')}}" method="post">
    @csrf
    <div class="form-group">
      <label for="titulo">Titulo</label>
      <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo...">
    </div>
    <div class="form-group">
      <label for="texto">Texto descriptivo</label>
      <textarea type="text" class="form-control" name="texto" id="texto" placeholder="Texto..."></textarea>
    </div>
    <div class="form-group">
      <label for="url_img">URL de la imagen</label>
      <input type="text" class="form-control" name="url_img"  id="url_img" placeholder="URL...">
    </div>
    <div class="form-group">
      <label for="url_img">URL de la noticia</label>
      <input type="text" class="form-control" name="url_noticia"  id="url_img" placeholder="URL...">
    </div>
    <div class="form-check">
      <h3>Curso</h3>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="curso[125]" value="0">
        <label class="form-check-label" for="exampleCheck1">General</label>
      </div>
      @include('layouts.checkboxCursos')
    </div>
    <button type="submit" class="btn btn-primary">Cargar</button>
  </form>
</div>
@endsection
