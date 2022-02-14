@extends('layouts.app')

@section('content')
<a href="{{route('Problem.index')}}" class="btn btn-danger m-3"><-----Volver</a>

    <div class="alert alert-secondary m-3">
        <h3>{{$problem->sintoma}}</h3>
        <p>{{$problem->descripcion}}</p>
    </div>
    <div class="card m-3 p-3">
        <form action="{{route('Problem.addStep',['Problem' => $problem])}}" method="post">
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
                <textarea class="form-control" name="descripcion" value="{{old('descripcion')}}" aria-label="With textarea"></textarea>
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
    @foreach ($problem->steps as $step)
        <div class="card m-3">
            <div class="card-header bg-danger text-white">
                Paso N° {{$step->numero}}
            </div>
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-4">
                        <p>{{$step->descripcion}}</p>

                    </div>
                    <div class="col-8">
                        <div class="row">

                            @foreach ($step->imgStep as $img)
                            <div class="col-4 border border-info p-3">
                                <img width="100%" src="{{$img->url}}" alt="img-{{$img->id}}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between">

                    <a class="btn btn-primary" href="{{route('Problem.showSteptoEdit',['Step' => $step])}}">Editar</a>
                    <a class="btn btn-danger" 
                        onclick="javascript: return confirm('Seguro que desea eliminar el paso?')" 
                        href="{{route('Problem.destroyStep',['Step' => $step])}}"
                    >Eliminar</a>
                </div>
            </div>
        </div>
    @endforeach
@endsection