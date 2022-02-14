@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-3">

            <form action={{ route('Kit.store') }} method="post">
                @csrf
                <div class="input-group mb-3">
                    <p>
                        <strong>Numero Alumno: </strong>
                        <input type="text" class="form-control" name="user_id" value="{{ $user->id }}" readonly> 
                    </p>
                </div>
                <div class="input-group mb-3">
                    <strong>Estado: </strong>
                    <div class="input-group mb-3">
                      <select  class="custom-select" name="estado" >
                        <option class="dropdown-item font-weight-bold" value="{{@$user->datosKit['estado'] ?? 'pendiente'}}"><strong> {{@$user->datosKit['estado'] ?? 'Seleccione estado' ?? 'Seleccione un estado'}}</strong></option>
                        <option class="dropdown-item" value="pendiente">Pendiente</option>
                        <option class="dropdown-item" value="enviado">Enviado</option>
                        <option class="dropdown-item" value="recibido">Recibido</option>
                      </select >
                    </div>
                </div>
                @include('layouts.kit-types',['user_id'=> $user->id])
                <div class="input-group mb-3">
                    <p>
                        <strong>Codigo Seguimiento: </strong>
                        <input type="text" class="form-control" name="codigo_seguimiento" placeholder="Codigo seguimiento..." value="{{$user->datosKit['codigo_seguimiento'] ?? null}}" > 
                    </p>
                </div>
                <input type="submit" value="Cargar" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection