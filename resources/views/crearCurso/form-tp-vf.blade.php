@extends('layouts.app')

@section('content')
<a class="btn btn-outline-danger" href="/Unidad/Editar?id={{$unity_id}}">Volver</a>
<div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text bg-success" id="basic-addon1">Pregunta nueva: </span>
    </div>
    
    <form action={{route('TpVf.newAfirmation')}} method="post">
        @csrf
        <div class="d-flex justify-content-between">
        <input type="hidden" name="unity_id" value="{{$unity_id}}" >
        <input type="hidden" name="tp_id" value="{{$tp->id ?? null}}" >
        <input type="text" size="130" class="form-control" name="afirmation" placeholder="Afirmacion">
        <div class="input-group-text bg-success">
           <strong> V </strong>&nbsp;<input type="checkbox" name="value" >
        </div>
        <input class="btn btn-success ml-2" type="submit" value="Cargar">
        </div>
    </form>
  </div>
@if ($tp != null)
    

    @foreach ($tp->afirmations as $index => $afirmation )
        
        <div class="card">
            <div class="card-header bg-info">
               <small> Pregunta N°{{$index+1}}</small>
               <form action={{route('TpVf.newAfirmation')}} method="post">
                    @csrf
                    <div class="d-flex justify-content-between">
                        <input type="hidden" name="unity_id" value="{{$unity_id}}" >
                        <input type="hidden" name="tp_id" value="{{$tp->id}}" >
                        <input type="hidden" name="afirmation_id" value="{{$afirmation->id}}" >
                        <input type="text" size="130" class="form-control" name="afirmation" value="{{$afirmation->afirmation}}">
                        <div class="input-group-text bg-success">
                        <strong> V </strong>&nbsp;
                        @if ($afirmation->true)
                            
                        <input type="checkbox" name="value" checked>
                        @else
                        <input type="checkbox" name="value">
                        @endif
                        </div>
                        <input class="btn btn-success ml-2" type="submit" value="Editar">
                        <a class="btn btn-danger" 
                            href="{{route('TpVf.deleteAf',['id'=>$afirmation->id, 
                                                            'unity_id' =>$unity_id,
                                                            'tp_id' => $tp->id
                                                            ])}}"
                        >Eliminar</a>
                    </div>
                </form>
            </div>
    @endforeach
@endif
@endsection