@extends('layouts.app')


@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="media mb-3">
          <img width="160px" class="border border-dark rounded-circle mr-3 flotante" src={{ asset('img/gerente.png') }} class="mr-3" alt="Gerente"> 
          <div class="media-body" style="height: 100%;" >
              <div class="card" style="height: 100%;">
                  <div class="card-header bg-dark text-white">
                    <div class="d-flex justify-content-between">
                      <h5 class="mt-0">{{$user->name}}</h5>
                    </div>
                  </div>
                  <div class="card-body">
                      <ul class="list-group">
                          <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                              <div class="border p-3">
                                <strong>Ventas del mes:</strong>
                                <h3 class="text-center text-2xl">{{count($ventasMes)}}</h3>
                              </div>
                              <div class="d-flex align-items-center">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalVentas">Ver Ventas</button>
                              </div>
                            </div>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
        </div>

        <hr>
        <div class="row">
          <div class="col">
            <div class="card" >
              <div class="card-header bg-danger font-weight-bolder text-white">
                Gestion Alumnos
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="{{route ('crearAlumno')}}">Crear Usuario</a></li>
                <li class="list-group-item"><a href="{{route ('Admin.Buscador')}}">Buscador Alumnos  </a></li>
                <li class="list-group-item"><a href="{{route('Admin.CadenaMail')}}">Cadena de mails</a></li>
                <li class="list-group-item"><a href="{{route('Cobro.index')}}">App Cobranza</a><span class="badge badge-danger">New</span> </li>
                <li class="list-group-item">
                  <div class="d-flex  justify-content-between" style="height: 25px">
                    <a href="{{route('Admin.verUserTest')}}">Alumnos test </a>
                    @if ($notificacionTest != 0)
                    <div style="height: 100%" class="d-flex">
                      <img style="height:100%" src={{ asset('img/notification-bell.png') }}>
                      <div 
                        style="height: 30px;width: 30px;border-radius:20px;font-weight:bold;" 
                        class="bg-danger text-center text-white p-1"
                      >
                        {{$notificacionTest ?? 0}}
                      </div>
                    </div>
                        
                    @endif
                  </div>
                </li>
                <li class="list-group-item">
                  <a href="{{route('Cobranza.verVentasRango')}}">Rango de ventas</a>
                </li>
              </ul>
            </div>

            <div class="collapse mt-3 border p-3" id="collapseTienda">
              @if (count($tiendaPendiente) != 0)
                  <p><b>Usuarios:</b></p>
                  <ul class="list-group">
                    @foreach ($tiendaPendiente as $pend)
                        <li class="list-group-item">
                          <a href="{{route('User.modificarAlumno',['id' =>$pend->user->id ])}}">{{$pend->user->name}}</a>
                        </li>
                    @endforeach
                  </ul>
              @else
                  <div class="alert alert-info">No hay compras pendientes</div>
              @endif
            </div>
          </div>

          <div class="col">
     
            <div class="card">
              <div class="card-header bg-warning">
                Accesos
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="/desarrollo">Ir a desarrollo</a></li>
                <li class="list-group-item">
                  <div class="d-flex  justify-content-between" style="height: 25px">
                    <a href="/postventa">Ir a postventa</a>
                    @if ($practicas != 0)
                    <div style="height: 100%" class="d-flex">
                      <img style="height:100%" src={{ asset('img/notification-bell.png') }}>
                      <div 
                        style="height: 30px;width: 30px;border-radius:20px;font-weight:bold;" 
                        class="bg-danger text-center text-white p-1"
                      >
                        {{$practicas ?? 0}}
                      </div>
                    </div>
                        
                    @endif
                  </div>
                </li>
                <li class="list-group-item"><a href="{{route('VerNoHabilitados')}}">Ver no habilitados </a></li>
                <li class="list-group-item">
                  <div class="d-flex  justify-content-between" style="height: 25px">
                    <a href="{{route('verConsultas')}}">Ver consultas </a>
                    @if ($notificacion != 0)
                    <div style="height: 100%" class="d-flex">
                      <img style="height:100%" src={{ asset('img/notification-bell.png') }}>
                      <div 
                        style="height: 30px;width: 30px;border-radius:20px;font-weight:bold;" 
                        class="bg-danger text-center text-white p-1"
                      >
                        {{$notificacion ?? 0}}
                      </div>
                    </div>
                        
                    @endif
                  </div>
                </li>
                
                <li class="list-group-item"><a href="{{route('Admin.verVendedoras')}}">Ver vendedoras</a></li>
                <li class="list-group-item"><a href="{{route('Kit.showAll')}}">Ver kits</a></li>
              </ul>
            </div>

          </div>
          @include('layouts.comisiones')
        </div>
        
      </div>
      <div class="col">
       
        <div class="row mb-3">

          <div class="col-6">

            <div class="card">
              <div class="card-header">
                Gestion Cuentas
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="{{route ('Cuenta.create')}}">Añadir cuenta</a></li>
                <li class="list-group-item"><a href="{{route ('Cuenta.index')}}">Ver cuentas</a></li>
              </ul>
            </div>
          </div>
          <div class="col-6">
            <div class="card">
              <div class="card-header bg-dark text-white">
                Gestion Cupones 
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href={{ route('Cupon.create') }}>Crear nuevo cupon</a></li>
                <li class="list-group-item"><a href={{ route('Cupon.index') }}>Ver todos los cupones</a></li>
    
              </ul>
            </div>

          </div>
        </div>


        <div class="card">
          <div class="card-header bg-info font-weight-bolder">
            Configuracion
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><a href={{ route('Objetivo.index') }}>Modificar objetivo</a></li>
            <li class="list-group-item"><a href={{ route('CourseTest.index') }}>Cursos Test</a></li>
            <li class="list-group-item"><a href={{ route('Tienda.admin') }}>Configuracion tienda</a></li>
          </ul>
        </div>
        
        <div class="card mt-3">
          <div class="card-header bg-dark text-white font-weight-bolder">
            <div class="d-flex justify-content-between">
              <p>Informacion</p>
              <button class="btn btn-dark" data-target="#collapseInfo" data-toggle="collapse">↓</button>
            </div>
          </div>

          <div class="card-body collapse show" id="collapseInfo" >
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Ingresos Vendedoras</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Ingresos Alumnos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Avisos de pago <span class="badge badge-danger">{{count($avisosPago)}}</span> </a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="list-group">
                  @foreach ($ingresos as $ingreso)
                  <a class="list-group-item p-1" href="/modificarAlumno?id={{$ingreso->user_id}}">{{$ingreso->user->name}}</a>
                  @endforeach
                </div>
              </div>
              <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <table class="table">
                  <thead>
                    <th scope="row">Nombre</th>
                    <th scope="row">Ingreso</th>
                  </thead>
                  <tbody>
                    @foreach ($ingresosVendedoras as $ingreso)
                    <tr>
                      <td><a href="{{route('Vendedor.perfil',['id'=>$ingreso->user->id])}}">{{$ingreso->user->name}}</a></td>
                      <td>{{$ingreso->created_at}}</td>
                    </tr>
                    @endforeach  
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <table class="table">
                  <thead>
                    <th scope="row">Nombre</th>
                    <th scope="row">Fecha del aviso</th>
                  </thead>
                  <tbody>
                    @foreach ($avisosPago as $aviso)
                    <tr>
                      <td><a href="{{route('User.modificarAlumno',['id'=>$aviso->user->id])}}">{{$aviso->user->name}}</a></td>
                      <td>{{$aviso->updated_at}}</td>
                    </tr>
                    @endforeach  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Modal -->
<div class="modal fade" id="ModalVentas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog mw-100 w-70 mr-3 ml-3" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ventas del mes</h5>
        <a href={{ route('Admin.verVentasMes') }} class="btn btn-primary ml-3">Ver mas...</a>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body overflow-auto">
        <table class="table table-hover">
          <thead class="bg-info">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Vendedora</th>
              <th scope="col">Nombre Alumno</th>
              <th scope="col">Email Alumno</th>
              <th scope="col">Tipo Pago</th>
              <th scope="col">Info Kit</th>
              <th scope="col">Tarjeta</th>
              <th scope="col">Fecha</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($ventasMes as $indice => $venta)  
            
            <tr>
              
              <th scope="row">{{$venta->datosAlumno['id']}}</th>
              <td>{{$venta->datosVendedor['name']}}</td>
              <td>{{$venta->datosAlumno['name']}}</td>
              <td><a href={{ route('User.modificarAlumno', ['id'=>$venta->alumno]) }}>{{$venta->datosAlumno['email']}}</a></td>
              <td>{{$venta->datosAlumno['tipo_pago']}}</td>
              <td>{{$venta->datosAlumno->datosKit->estado ?? ''}} </td>
              <td>{{$venta->datosUser['tarjeta'] ?? 'sin cargar'}}</td>
              <td>{{$venta->fecha}}</td>
            </tr>
            @php
                if ($indice > 15){
                break;
                }
                
            @endphp
            
 
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <a href={{ route('Admin.verVentasMes') }} class="btn btn-info">Ver mas...</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@if (session('msg') == 'success')  
<script>
  swal('Great!','Modificado o cargado con exito', 'success');
</script>
@endif
@endsection
