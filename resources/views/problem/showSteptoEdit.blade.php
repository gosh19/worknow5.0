@extends('layouts.app')

@section('content')
<a class="btn btn-danger" href="{{route('Problem.index')}}"><----Volver</a>
    <div class="container">
        <div class="card mb-3">
            <div class="card-header bg-secondary text-white">
                Edicion de Step
            </div>
            <div class="card-body">
                <form action="{{route('Problem.editStep',['Step' => $step])}}" method="post">
                    @if ($errors->has('descripcion') || $errors->has('numero'))
                        <div class="alert alert-danger">
                            <p>Complete todos los campos</p>
                        </div>
                    @endif
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Descripcion</span>
                        </div>
                        <textarea class="form-control" name="descripcion" value="{{old('descripcion')}}" aria-label="With textarea">{{$step->descripcion}}</textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Numero</span>
                        </div>
                        <input type="number" class="form-control" name="numero" value="{{old('numero') ?? $step->numero}}" placeholder="paso numero...">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Actualizar">
                </form>
            </div>
        </div>
        <div class="card p-3">
            @if ($errors->has('image'))
                <div class="alert alert-danger">
                    <p>Debe seleccionar un archivo para cargar</p>
                </div>
            @endif
            <form action="{{route('Problem.addImgtoStep', ['Step' => $step])}}" enctype="multipart/form-data" method="post">
                @csrf
                <input type="file" name="image">
                <input type="submit" class="btn btn-primary" value="Cargar">
            </form>
            <hr>
            @if (count($step->imgStep) == 0)
                <div class="alert alert-info">
                    <p>Aun no haz agregado ninguna imagen</p>
                </div>
            @else 
            <div class="row p-3">

                @foreach ($step->imgStep as $index => $img)
                <div class="col-4 border border-primary rounded p-3 mb-3">
                    <div class="d-flex justify-content-between">

                        <p>{{$index+1}}</p>
                        <a class="btn btn-danger" 
                            onclick="javascript: return confirm('Seguro que desea eliminar la imagen?')" 
                            href="{{route('Problem.deleteImgStep',['ImgStep' => $img])}}"
                        >Eliminar</a>
                    </div>
                    <img width="100%" src="{{$img->url}}" alt="image-{{$img->id}}">
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
@endsection