@extends('layouts.app')

@if ($user->infoFac == null)
    @section('anuncio')
        <div class="alert alert-danger text-center">
          <h1>Atencion</h1>
          <p>El alumno no tiene informacion de facturacion cargada</p>
        </div>
    @endsection
@endif

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">

            @include('admin.modificarAlumno.cajaUser',['user' => $user,'mesesCursados' => $mesesCursados])
            <div class="card">
                <div class="card-header bg-success">
                    <div class="d-flex justify-content-between">

                        <p class="font-weight-bolder">Datos de venta</p>
                        
                        <button class="btn btn-dark" data-bs-toggle="collapse" href="#cajaVenta">+</button>
                    </div>
                </div>
                <div class="collapse" id="cajaVenta">

                    <div class="card-body">
                        @include('admin.modificarAlumno.venta',['user' => $user])
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-7">
            @if ($user->carritoEstado('pendiente') != null)  
              <div class="mb-3">
                @include('admin.modificarAlumno.cajaCarritoPendiente',['pendiente' => $user->carritoEstado('pendiente')])
              </div>
            @endif
            @if ($user->carritoEstado('confirmado') != null)  
              <div class="mb-3">
                @include('admin.modificarAlumno.cajaCarritoPendiente',['pendiente' => $user->carritoEstado('confirmado')])
              </div>
            @endif
            <div class="mb-3">

                @include('admin.modificarAlumno.cajaEstado',['user' => $user])
            </div>
            <div class="mb-3">
              <div class="card">
                <div class="card-body">
                    <a href="{{route('User.verRotulo',['User'=> $user])}}" class="btn btn-primary btn-block">Generar rotulo</a>
                    <hr>

                    <form action="{{route('User.cargarProductos',['User'=> $user])}}" method="post">
                      @csrf
                      <div class="row">
                        <div class="col-8">
                          <div class="form-group">
                            <input type="number" name="cantidad" class="form-control {{$errors->has('cantidad') ? 'border border-danger': ''}}" id="">
                            <small class="form-text {{$errors->has('cantidad') ? 'text-danger': 'text-muted'}} ">Coloque la cantidad de productos a cargar</small>
                          </div>
                        </div>
                        <div class="col-1">
                          <i style="color: rgb(175, 44, 11);" class="far fa-arrow-alt-circle-right fa-2x"></i>
                        </div>
                        <div class="col-3">
                          <input type="submit" value="Continuar" class="btn btn-danger btn-block">
                        </div>
                      </div>
                    </form>

                </div>
              </div>
            </div>
            <div>

              @include('admin.modificarAlumno.cajaCursos',['user' => $user,'cursos' => $cursos])
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col m-3">
        <div class="collapse bg-light" id="collapseCursos">
            <table class="table table-striped mt-5">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Accion</th>
                <tr>
              </thead>
                <tbody>
                  @foreach ($cursos as $curso)

                    <tr>
                      <td>{{$curso->id}}</td>
                      <td>{{$curso->nombre}}</td>
                      <td><a href="{{route('Curso.agregarAlumno', ['user_id' => $user->id, 'course_id' => $curso->id])}}" class="btn btn-danger">Agregar al curso</a></td>
                    </tr>

                  @endforeach
                </tbody>
            </table>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col m-3">

            @include('admin.modificarAlumno.cajaCobranza',['user' => $user])
        </div>
    </div>
</div>
@endsection