@extends('layouts.app')

@section('content')
@if (session()->has('msj'))
    <div class="alert alert-success text-center w-100 p-3">
        <p>{{session('msj')}}</p>
    </div>
@endif
<a href="{{route('Practice.index')}}" class="btn btn-danger m-3">Volver</a>

<div class="alert alert-secondary m-3">
        <div class="row">
            <div class="col-md-6">
                <h3>{{$practice->titulo}}</h3>
                <p>{{$practice->desc}}</p>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-around">

                    @foreach ($practice->imgs as $img)
                        <div class="p-1">
                            <img src="{{$img->url}}" width="100px" alt="">
                            <a onclick="javascript: return confirm('Seguro que desea eliminar la imagen?')" href="{{route('Practice.deleteImg',['ResourcePractice'=> $img])}}" class="text-danger font-weight-bolder ml-1">x</a>
                        </div>
                    @endforeach
                </div>
            </div>
    </div>
    

    <hr>
    <div class="d-flex justify-content-between">
        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapsePractice">Editar</a>
        <a class="btn btn-success" data-bs-toggle="collapse" href="#collapseAddImg">Agregar imagenes</a>
        <a class="btn btn-danger text-white" href="{{route('Practice.delete',['Practice'=> $practice])}}" onclick="javascript: return confirm('Seguro que desea eliminar la practica?')" >Eliminar</a>
    </div>
</div>
<div class="collapse" id="collapsePractice">
    <div class="p-3 m-3 border border border-primary rounded">
        <h2 class="text-primary">Edicion de datos de practica</h2>
        <hr>
        <form action="{{route('Practice.update',['Practice'=> $practice])}}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Titulo</label>
                <input type="text" class="form-control" value="{{$practice->titulo}}" name="title">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Descripcion</span>
                </div>
                <textarea class="form-control" name="desc">{{$practice->desc}}</textarea>
            </div>
            <input type="submit" class="btn btn-danger btn-block" value="Actualizar">
        </form>
    </div>
</div>

<div class="collapse" id="collapseAddImg">
    <div class="border border-success p-3 m-3">

        <form action="{{route('Practice.addImg',['practice_id'=>$practice->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="img" required>
            <input type="submit" class="btn btn-danger" value="Cargar">
        </form>
    </div>
</div>

<div class="card m-3">
    <div class="card-header bg-primary text-white font-weight-bold">
        Creacion de nuevo paso para la practica
    </div>
    <div class="card-body">
        <form action="{{route('Practice.addStep',['practice_id'=>$practice->id])}}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Titulo</label>
                <input type="text" class="form-control" value="{{old('title')}}" name="title" id="title" placeholder="Titulo...">
                @if ($errors->has('title'))
                    <small class="text-danger">Error X</small>
                @endif
            </div>
            @if ($errors->has('desc') || $errors->has('numero'))
                <div class="alert alert-danger">
                    <p>Complete todos los campos</p>
                </div>
            @endif
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text">Descripcion</span>
                </div>
                <textarea class="form-control" name="desc" value="{{old('desc')}}" aria-label="With textarea"></textarea>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Numero</span>
                </div>
                <input type="number" class="form-control" name="numero" value="{{old('numero')}}" placeholder="paso numero...">
            </div>
            <input type="submit" class="btn btn-primary" value="Cargar">
        </form>
    </div>
</div>
@foreach ($practice->steps as $step)
    <div class="card m-3">
        <div class="card-header bg-danger text-white">
            Paso N° {{$step->numero}}
        </div>
        <div class="card-body p-3">
            <div class="row">
                <div class="col-2">
                    
                    <p>{{$step->titulo}}</p>
                </div>
                <div class="col-4">
                    <div class="row">
                        <p>{{$step->desc}}</p>
                        
                    </div>
                </div>
                <div class="col-6">
                    @foreach ($step->imgs as $img)
                        <div class="p-1">
                            <img src="{{$img->url}}" width="100px" alt="">
                            <a onclick="javascript: return confirm('Seguro que desea eliminar la imagen?')" href="{{route('Practice.deleteImgStep',['ResourceStepPractice'=> $img])}}" class="text-danger font-weight-bolder ml-1">x</a>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">

                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#editCollapse-{{$step->id}}" aria-expanded="false"
                    aria-controls="editCollapse-{{$step->id}}">
                    Editar
                </button>         
                <a class="btn btn-success" data-bs-toggle="collapse" href="#collapseAddImgtoStep-{{$step->id}}">Agregar imagenes</a>       
                <a class="btn btn-danger" 
                    onclick="javascript: return confirm('Seguro que desea eliminar el paso?')" 
                    href="{{route('Practice.deleteStep',['StepPractice' => $step])}}"
                >Eliminar</a>
            </div>
        </div>
    </div>
    <p>
        
    </p>
    <div class="collapse" id="editCollapse-{{$step->id}}">
        <div class="p-3 border rounded border-danger m-3">
            <h3 class="text-danger">Edicion de paso N° {{$step->numero}} </h3>
            <hr>
            <form action="{{route('Practice.editStep',['StepPractice' => $step])}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">Titulo</label>
                    <input type="text" class="form-control" value="{{$step->titulo}}" name="title" id="title" placeholder="Titulo...">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Descripcion</span>
                    </div>
                    <textarea class="form-control" name="desc" aria-label="With textarea">{{$step->desc}}</textarea>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Numero</span>
                    </div>
                    <input type="number" class="form-control" name="numero" value="{{$step->numero}}" placeholder="paso numero...">
                </div>
                <input type="submit" class="btn btn-primary" value="Cargar">
            </form>
        </div>
    </div>
    <div class="collapse" id="collapseAddImgtoStep-{{$step->id}}">
        <div class="border border-success p-3 m-3">   
            <form action="{{route('Practice.addImgtoStep',['step_id' => $step->id,'practice_id'=>$practice->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="img" required>
                <input type="submit" class="btn btn-danger" value="Cargar">
            </form>
        </div>
    </div>
@endforeach
@endsection