<table class="table table-striped">
    <thead>
        <th>Id</th>
        <th>Nombre</th>
        <th>Mail</th>
        <th>Cobros</th>
        <th>Vendedora</th>
        <th>Ult. modificacion</th>
        <th>---</th>
    </thead>
    <tbody>
        @foreach ($kits as $key => $kit)
            @php
                $theme = '';
                switch ($kit->estado) {
                    case 'enviado':
                        $theme = 'bg-success';
                        break;
                    case 'recibido':
                        $theme = 'bg-primary';
                        break;
                }
            @endphp
            <tr class="{{ $theme}}">

                <td scope="row">{{$kit->user_id}}</td>
                <td><a href="{{route('User.modificarAlumno',['id' => $kit->user_id])}}">{{$kit->user->name}}</a></td>
                <td>{{$kit->user->email}}</td>
                <td>
                    @if (count($kit->user->cobros) != 0)
                        <ul class="list-group">

                            @foreach ($kit->user->cobros as $cobro)
                                <li class="list-group-item">$ {{$cobro->monto}} || {{date('m-Y' ,strtotime($cobro->fecha))}} </li>
                            @endforeach
                        </ul>
                    @else
                        Sin cobros cargados
                    @endif
                </td>
                <td>{{$kit->user->venta != null ? $kit->user->venta->datosVendedor->name:''}}</td>
                <td>{{date_format($kit->updated_at,'d-m-Y')}}</td>
                <td><button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modal-{{$kit->id}}">
                    Ver
                  </button></td>

            </tr>
            {{--MODAL DE DATOS DEL ALUMNO--}}
            <div class="modal fade" id="modal-{{$kit->id}}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: rgb(211, 115, 198);">
                      <h5 class="modal-title" id="exampleModalLabel">Kit</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" style="background-color: rgb(204, 142, 196);" >
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-group mb-3">
                                    <li class="list-group-item"><strong>Nombre : </strong>{{$kit->user->name}}</li>
                                    
                                </ul>
                                <div class="card p-3">

                                
                                    <form action={{ route('Kit.store',['back'=> true]) }} method="post">
                                        @csrf
                                        <div class="input-group mb-1">
                                            <p>
                                                <strong>Numero Alumno: </strong>
                                                <input type="text" class="form-control" name="user_id" value="{{ $kit->user_id }}" readonly> 
                                            </p>
                                        </div>
                                        <div class="input-group mb-1">
                                            <strong>Estado: </strong>
                                            <div class="input-group mb-3">
                                            <select  class="custom-select" name="estado" >
                                                <option class="dropdown-item font-weight-bold" value="{{$kit->estado ?? 'pendiente'}}"><strong> {{$kit->estado ?? 'Seleccione estado'}}</strong></option>
                                                <option class="dropdown-item" value="pendiente">Pendiente</option>
                                                <option class="dropdown-item" value="enviado">Enviado</option>
                                                <option class="dropdown-item" value="recibido">Recibido</option>
                                            </select >
                                            </div>
                                        </div>
                                        @include('layouts.kit-types',['user_id'=> $kit->user_id])
                                        <div class="input-group mb-1">
                                            <p>
                                                <strong>Codigo Seguimiento: </strong>
                                                <input type="text" class="form-control" name="codigo_seguimiento" placeholder="Codigo seguimiento..." value={{$kit->codigo_seguimiento ?? null}} > 
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="comentario" rows="2">{{$kit->comentario}}</textarea>
                                        </div>
                                        <input type="submit" value="Cargar" class="btn btn-primary">
                                    </form>
                                </div>
                            </div>
                            <div class="col-6">
                                <ul class="list-group mb-3">
                                    <li class="list-group-item"><strong>Direccion :  </strong>{{$kit->user->datosUser != null ? $kit->user->datosUser->direccion :'sin cargar'}}</li>
                                    <li class="list-group-item"><strong>Telefono :  </strong>{{$kit->user->datosUser != null ? $kit->user->datosUser->telefono :'sin cargar'}}</li>
                                    <li class="list-group-item"><strong>E-mail : </strong>{{$kit->user->email}}</li>
                                    <li class="list-group-item"><strong>DNI :  </strong>{{$kit->user->datosUser != null ? $kit->user->datosUser->dni :'sin cargar'}}</li>
                                    <li class="list-group-item"><strong>Ciudad : </strong> {{$kit->user->datosUser != null ? $kit->user->datosUser->ciudad :'sin cargar'}}</li>
                                    <li class="list-group-item"><strong>Provincia :  </strong>{{$kit->user->datosUser != null ? $kit->user->datosUser->provincia :'sin cargar'}}</li>
                                    <li class="list-group-item"><strong>Cp : </strong> {{$kit->user->datosUser != null ? $kit->user->datosUser->CP :'sin cargar'}}</li>
                                </ul>
                                <div>
                                    <a href="{{route('User.verRotulo',['User'=> $kit->user])}}" class="btn btn-primary btn-block">Generar rotulo</a>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                  </div>
                </div>
            </div>
        @endforeach
    </tbody>
</table>