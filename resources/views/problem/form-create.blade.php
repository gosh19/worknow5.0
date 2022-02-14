@extends('layouts.app')

@section('content')
<a href="{{route('Problem.index')}}" class="btn btn-danger"><-----Volver</a>
<div class="container">

  <div class="card p-3">
    @if (isset($problem))
        
    <form action="{{ route('Problem.actualizar',['id' => $problem->id]) }}" method="POST"  enctype="multipart/form-data" >
    @else
    <form action="{{ route('Problem.store') }}" method="POST"  enctype="multipart/form-data" >
        
    @endif
      @csrf
      <div class="form-group">
        <label for="simtoma">Sintoma</label>
        <input type="text" name="sintoma" class="form-control" value="{{ $problem->sintoma ?? old('sintoma')}}" id="simtoma" >
        @if ($errors->has('sintoma'))
            <p class="text-danger font-weight-bold">***Campo requerido</p>
        @endif
      </div>
      <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <textarea class="form-control" name="descripcion" id="descripcion" rows="3">
          {{ $problem->descripcion ?? old('descripcion')}}
        </textarea>
      </div>
      <hr>
      <div class="row">
        <div class="col-6">
          @if ($errors->has('course_id'))
          <div class="alert alert-danger">
            Debe seleccionar un curso al menos
          </div>
              
          @endif
          <h4 class="font-weight-bold">Selecciona el curso al que pertenece :</h4>
            @include('layouts.radioCursos2',['course_id' => $problem->course_id ?? null])
        </div>
        <div class="col-6">
          <h4 class="font-weight-bold">Carga de imagen :</h4>
          <input accept="image/*" type="file" name="imagen" >
          <div class="d-flex justify-content-center mt-3">
            @if (isset($problem ))
                @if ($problem->img != null)
                    
                <img class="border rounded border-primary p-3" width="60%" src="{{ $problem->img ?? null }}" alt="">
                @endif
            @endif
            <img width="60%" src="{{ asset('img/megafono.jpg') }}" alt="">
          </div>
        </div>
      </div>
      <hr>
      <div class="d-flex justify-content-center">

        <button type="submit" class="btn btn-primary">Cargar</button>
      </div>
    </form>
  </div>
</div>
@endsection