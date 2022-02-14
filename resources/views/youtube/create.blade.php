@extends('layouts.app')

@section('content')
  <form class="" action={{route('VideosYT.store')}} method="post">
    @csrf
    @include('layouts.radioCursos')
    <span>Titulo</span>
    <input type="text" name="titulo" value="">
    <span>Sub-Titulo</span>
    <input type="text" name="subtitulo" value="">
    <span>URL</span>
    <input type="text" name="html" value="">
    <input type="submit" name="" value="Cargar">
  </form>
@endsection
