<div class="card mb-3">
    <div class="card-header bg-dark text-white">
        <div class="d-flex justify-content-between">
            <h2 class="text-2xl">{{$user->id}}</h2>
            <h2 class="text-2xl">{{$user->name}}</h2>
            <div>
                @include('admin.modificarAlumno.country',['user'=>$user])
                
            </div>
        </div>
    </div>
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between">
            <div>

                Cursando desde hace  <strong> {{$mesesCursados}} </strong>{{$mesesCursados == 1 ? 'mes' :'meses' }}
            </div>
            <button type="button" class="btn btn-outline-primary " data-bs-toggle="modal" data-bs-target="#dataModal">
                Editar datos
            </button>
        </li>
        <li class="list-group-item d-flex justify-content-between">
            <p>
                <strong class="mr-3 text-danger">
                    Email : 
                </strong> 
                {{$user->email}}
            </p>
            <a class="btn btn-primary ml-4" href="{{route('User.sendAlta', ['id' => $user->id])}}">Re-enviar alta de estudiante</a><br>
        </li>
        <li class="list-group-item"><strong class="mr-3 text-danger">Tipo pago : </strong> {{$user->tipo_pago}}</li>
        <li class="list-group-item"><strong class="mr-3 text-danger">Fecha ingreso : </strong> {{date_format($user->created_at,'d-m-Y')}}</li>                    
        <li class="list-group-item d-flex justify-content-between">
            <div>

                @if ($user->kit)
                    @if ($user->datosKit != null )
                        @if ($user->datosKit->kit_type_id != null)
                            <span class="bg-primary p-1 rounded">{{$user->datosKit->kitType->name}}</span>
                        @endif

                        <span class="bg-info p-1 rounded text-white" >{{$user->datosKit->estado}} | {{$user->datosKit->codigo_seguimiento}} </span>
                        <span class="bg-{{$user->datosKit->confirmed? 'success':'danger'}} p-1 rounded text-white" >{{$user->datosKit->confirmed? 'Datos confirmado':'Datos sin confirmar'}}</span>
                        <a href={{ route('Kit.show', ['Kit'=>$user->id]) }} class="btn btn-warning ml-3 mt-3">Actualizar</a> 
                    @else  
                        <a href={{ route('Kit.show', ['Kit'=>$user->id]) }} class="btn btn-primary ml-3">Cargar</a> 
                    @endif
                @else
                <div class="alert alert-danger pb-0">

                  <p>No tiene kit cargado</p>
                </div>
                @endif
            </div>
            <div >
                  @if ($user->kit)
                    <a class="btn btn-dark" href="{{ route('User.modificarKit', ['User'=> $user,'kit'=>0]) }}">Quitar</a>
                  @else
                    <a class="btn btn-success" href="{{ route('User.modificarKit', ['User'=> $user,'kit'=>1]) }}">Agregar</a>
                  @endif
            </div>
        </li>    
        <li class="list-group-item text-center h-25 bg-dark">
            <button class="btn btn-primary btn-block btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                +
            </button>
        </li>     
        <div class="collapse" id="collapseExample">
            @if ($user->datosUser != null)
                <li class="list-group-item"><strong class="mr-3 text-dark">Direccion : </strong> {{$user->datosUser->direccion}}</li>
                <li class="list-group-item"><strong class="mr-3 text-dark">Telefono : </strong> {{$user->datosUser->telefono}}</li>
                <li class="list-group-item"><strong class="mr-3 text-dark">D.N.I. : </strong> {{$user->datosUser->dni}}</li>
                <li class="list-group-item"><strong class="mr-3 text-dark">Ciudad : </strong> {{$user->datosUser->ciudad}}</li>
                <li class="list-group-item"><strong class="mr-3 text-dark">Provincia : </strong> {{$user->datosUser->provincia}}</li>
                <li class="list-group-item"><strong class="mr-3 text-dark">Codigo Postal : </strong> {{$user->datosUser->CP}}</li>
                <li class="list-group-item"><strong class="mr-3 text-dark">Tarjeta : </strong> {{$user->datosUser->tarjeta}}</li>
            @endif
            <li class="list-group-item d-flex justify-content-center">
                <button type="button" class="btn btn-outline-danger " data-bs-toggle="modal" data-bs-target="#dataUserModal">
                    Editar datos
                </button>
            </li>
        </div>
    </ul>
</div>

{{--MODAL DE EDICION DE DATOS DE USER--}}
<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog mw-100 m-5">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edicion de datos</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-6">
              <form action="{{ route('User.update', ['user_id'=> $user->id]) }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="name">Nombre</label>
                  <input type="text" class="form-control" id="name" value="{{$user->name}}" name="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" lass="form-control" id="email">
                    <small id="emailHelp" class="form-text text-danger">Completar unicamente si se va a modificar el email.</small>
                </div>
                <div class="form-group">
                    <label for="pasword">Password</label>
                    <input type="text" class="form-control" name="password" id="password" value="">
                    <small id="passHelp" class="form-text text-danger">Completar unicamente si se va a modificar la contraseña.</small>
                </div>
                <div class="form-group">
                    <p><strong>Tipo pago: </strong>
                      <select name="tipo_pago" class="custom-select">
                        <option class="font-weight-bold" selected value="{{ $user->tipo_pago }}" >{{ $user->tipo_pago }}</option>
                        <option value="test">Test</option>
                        <option value="credito">Credito</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="efectivoTotal">Efectivo Total</option>
                      </select>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
              </form>
            </div>
            <div class="col-6">
              <div class="d-flex justify-content-center">
                <img src="{{ asset('img/lupa.jpg') }}" width="60%" alt="">
              </div>
              @if ($user->infoFac == null)
                  <div class="alert alert-danger">
                    <p>Recuerda cargar la informacion de facturacion</p>
                  </div>
              @endif
            </div>
          </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
{{--END MODAL--}}

{{--MODAL DE EDICION DE DATOS_USER--}}
<div class="modal fade" id="dataUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog mw-100 m-5">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edicion de datos</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('User.update', ['user_id'=> $user->id]) }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="adress">Direccion</label>
                  <input type="text" class="form-control" id="adress" value="{{$user->datosUser->direccion ?? ''}}" name="direccion">
                </div>
                <div class="form-group">
                    <label for="CP">Codigo Postal</label>
                    <input type="text" class="form-control" id="adress" value="{{$user->datosUser->CP ?? ''}}" name="CP">
                </div>
                <div class="form-group">
                    <label for="phone">Telefono</label>
                    <input type="text" class="form-control" id="phone" value="{{$user->datosUser->telefono ?? ''}}" name="phone">
                </div>
                <div class="form-group">
                    <label for="dni">D.N.I</label>
                    <input type="text" class="form-control" id="dni" value="{{$user->datosUser->dni ?? ''}}" name="dni">
                </div>
                <div class="form-group">
                    <label for="city">Ciudad</label>
                    <input type="text" class="form-control" id="city" value="{{$user->datosUser->ciudad ?? ''}}" name="city">
                </div>
                <div class="form-group">
                    <label for="province">Provincia</label>
                    <input type="text" class="form-control" id="province" value="{{$user->datosUser->provincia ?? ''}}" name="province">
                </div>
                <div class="form-group">
                    <label for="tarjeta">Tarjeta</label>
                    <input type="text" class="form-control" id="tarjeta" value="{{$user->datosUser->tarjeta ?? ''}}" name="tarjeta">
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
{{--END MODAL--}}