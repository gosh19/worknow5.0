@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card w-75">
            <div class="card-header">
                Edicion de datos
            </div>
            <div class="card-body">
                <form action="{{route('VideosYT.updateV')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$video->id}}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Titulo</label>
                        <input type="text" class="form-control" name="titulo" value="{{$video->titulo}}" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Sub-Titulo</label>
                        <input type="text" class="form-control" name="subtitulo" value="{{$video->subtitulo}}" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">URL</label>
                        <input type="text" class="form-control" name="url" value="{{$video->html}}" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary">Cargar</button>
                </form>
            </div>
        </div>
    </div>
@endsection