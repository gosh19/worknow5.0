@extends('layouts.app')

@section('content')

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">E-mail</th>
      <th scope="col">Vendedora</th>
      <th scope="col">---</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
    
    <tr>
      <th scope="row">{{$user->id}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->venta->datosVendedor->name ?? ''}} </td>
      <!-- Button trigger modal -->
      <td>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#id{{$user->id}}">
        Habilitar
      </button>
      </td>
    </tr>
    



<!-- Modal -->
<div class="modal fade" id="id{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cargar informacion de facturacion para {{$user->name}}</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="modificar-hab/{{$user->id}}" method="GET" >
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text bg-danger text-white font-weight-bolder" id="basic-addon1">$</span>
            </div>
            <input type="number" class="form-control" value="1200" placeholder="Valor Cuota..." name="valor_cuota">
          </div>
          <div class="form-group">
            <label >Cantidad de cuotas</label>
            <input type="number" class="form-control" name="cant_cuotas" value="6" placeholder="Cantidad de cuotas...">
          </div>
          <div class="row">

            <div class="col-6">

              <div class="form-group">
                <label class="text-lg text-red-800 font-bold">Comision</label>
                <input type="number" class="form-control" name="comision" value="0">
              </div>
              <hr>
            </div>
            <div class="col-6">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <input type="checkbox" name="cargar_cobro">
                  </div>
                </div>
                <div class="ml-3">
                  <h5>Cargar cobro</h5>
                </div>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <input type="checkbox" name="con_kit">
                  </div>
                </div>
                <div class="ml-3">
                  <h5>Con Kit</h5>
                </div>
              </div>
            </div>
          </div>
          

          <div class="d-flex justify-content-lg-between">
            <button type="submit" class="btn btn-success">Habilitar</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endforeach
</tbody>
</table>
@endsection
