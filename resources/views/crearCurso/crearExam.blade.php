@extends('layouts.app')

@section('content')
  <div class="container">
    <form class="" action="/CargarExamen" method="post">
      @csrf

        @include('layouts.radioCursos')

        <div id="form-preguntas">

        </div>

      <button type="submit" name="button" class="btn btn-danger">Siguiente</button>
    </form>
  </div>

@endsection
