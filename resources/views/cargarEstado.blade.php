@extends('layouts.app')

@section('content')

  @if(session()->has('creado'))
    <script>
        swal("Estado Creado", "Se ah creado el estado con exito", "success");
    </script>
  @endif

  @if(session()->has('estadonulo'))
    <script>
        swal("El alumno no tiene estado", "Por favor, para continuar debe crearle un estado al mismo", "success");
    </script>
  @endif


<div class="container">
  <div class="row justify-content-center">
    <div class="alert alert-danger">Antes de cargar un estado debe estar seguro que no existe un estado en la base de datos </div>
    <a  type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-danger">Cargar Nuevo Estado</a>
  </div>
</div>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cargando Estado de alumno</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('Estado.store')}}" method="GET">
            <div class="form-group">
              <label class="text-secondary text-center">Tipo de Cobro (debito, credito)</label>
              <input type="text" class="form-control" name="tipo" />
              <input type="hidden" value="{{$_GET['id']}}" name="user_id" />
              <input type="hidden" value="{{$_GET['mes']}}" name="mes" />
            </div>
            <div class="form-group">
              <label class="text-secondary text-center">Valor de la cuota</label>
              <input type="number" class="form-control" name="valor" />
            </div>
            <div class="form-group">
              <label class="text-secondary text-center">Ingrese la cantidad de cuotas</label>
              <input type="number" class="form-control" name="cant_cuotas" placeholder=""/>
            </div>
            <div class="form-group">
              <label class="text-secondary">Cuotas pagas</label>
              <input type="number" class="form-control" name="cuotas_pagas" />
            </div>
            <div class="form-group">
              <label class="text-secondary">Valor Restante</label>
              <input type="number" class="form-control" name="valor_restante" />
            </div>
            <div class="form-group">
              <label class="text-secondary">fecha siguiente cobro</label>
              <input id="date" type="date" name="fecha_siguiente_cobro">
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-danger" value="Guardar Estado" />
        </div>
      </div>
    </div>
  </div>

@endsection
