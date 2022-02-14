@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        Noticia cargada con exito
    </div>
@endif
<div class="row d-flex justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Cargar nueva novedad
            </div>
            <div class="card-body">
                @if (isset($novedad))
                
                <form action="{{route('Novedad.actualizar',['novedad' => $novedad])}}" method="POST">
                    <input type="hidden" name="id" value="{{$novedad->id}}">
                @else
                <form action="{{route('Novedad.store')}}" method="POST">
                @endif
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Titulo</label>
                                <input type="text" name="titulo" value="{{ $novedad->titulo ?? old('titulo') }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sub-Titulo</label>
                                <input type="text" name="subtitulo" value="{{$novedad->subtitulo ?? old('subtitulo') }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">URL</label>
                                <input type="text" name="url" value="{{$novedad->url ?? old('url') }}" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Cargar</button>
                            <a class="btn btn-danger" href="{{route('Novedad.index')}}">Volver</a>
                        </div>
                        <div class="col-6">
                            @if ($errors->has('course_id'))
                            <div class="alert alert-danger">
                                Debe seleccionar al menos un curso
                            </div>
                            @endif
                            @include('layouts.radioCursos2')
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection