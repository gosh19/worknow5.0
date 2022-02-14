@extends('layouts.app')

@section('content')

  <form action="{{ route('Video.store')}}" class="mt-3" method="POST" enctype="multipart/form-data">
    @csrf
        @include('layouts.radioCursos')
        <div class="alert alert-danger">
          Seleccione desde su pc el video que desea cargar.
        </div>
        <input className="btn btn-danger" name="video" type="file"  />
        <input type="submit" class="btn btn-danger" value="Cargar Video"/>
  </form>

@endsection
