<div class="card">
    <div class="card-header bg-conf d-flex justify-content-between">
        <p>

            Seccion cobranza
        </p>
        <div class="custom-control custom-switch">
            <input type="checkbox" data-toggle="collapse" data-target="#cobranzaCollapse" class="custom-control-input" id="customSwitch1">
            <label class="custom-control-label" for="customSwitch1">+</label>
        </div>
    </div>
    <div class="card-body " id="cobranzaCollapse">
      @if ($user->infoFac != null)
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info" >
                            <h5 class="text-2xl mb-3">Plan de pago</h5>
                            <hr class="mb-3">
                            <p class="mb-2"><strong>Tipo pago: </strong>{{$user->tipo_pago ?? 'Sin cargar'}} </p>
                            <p class="mb-2"><strong>Monto cuota: </strong>{{$user->infoFac->monto_cuota}} </p>
                            <p class="mb-2"><strong>Cantidad cuotas: </strong>{{$user->infoFac->cant_cuotas}} </p>
                            <p class="mb-2"><strong>Fecha siguienta cobro: </strong>{{$user->infoFac->fecha_sig_cobro}} </p>
                            <p class="mb-2">
                                <strong>Cobrable: </strong>
                                
                                @if ($user->infoFac->cobrable)
                                    <a class="btn btn-danger" 
                                        href={{route('Cobranza.modificarCobrable', ['id' => $user->id])}}
                                    >Desactivar</a> <br>
                                    <small style="color: green" >Aparece para cobrar</small>
                                @else
                                    <a class="btn btn-success" 
                                        href={{route('Cobranza.modificarCobrable', ['id' => $user->id])}}
                                    >Activar</a><br>
                                    <small style="color: red" >No aparece para cobrar</small>
                                @endif
                                
                            </p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="alert alert-success" role="alert">
                          <h4 class="alert-heading">Adicionales</h4>
                          @if (count($user->adicionales) != 0)
                            @foreach ($user->adicionales as $ad)
                                <div class="border p-2">
                                    <h5>{{$ad->denominacion}}</h5>
                                    <ul>
                                        <li><strong>Valor cuota : </strong> {{$ad->valor}}</li>
                                        <li><strong>Cant. cuotas : </strong>{{$ad->cant_cuotas}}</li>
                                        <li><strong>Denominacion : </strong>{{$ad->denominacion}}</li>
                                    </ul>
                                    <a href="{{route('Adicional.delete',['Adicional' => $ad])}}" onclick="javascript: return confirm('Seguro?')" class="btn btn-block btn-danger">Eliminar</a>
                                </div>
                            @endforeach
                          @else
                          <p>No hay adicionales</p>
                          @endif
                            <a data-toggle="collapse" href="#collapseAdicional" class="btn btn-primary mt-3">Crear nuevo adicional</a>
                            <div class="collapse" id="collapseAdicional">
                                <div class="border rounded border-primary p-3 mt-3">
                                    <form action="{{route('Adicional.store')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <div class="form-group">
                                          <label for="valor_cuota">Valor cuota</label>
                                          <input type="number" class="form-control" placeholder="$..." name="valor_cuota" id="valor_cuota">
                                        </div>
                                        <div class="form-group">
                                            <label for="valor_cuota">Cant. cuotas</label>
                                            <input type="number" class="form-control" value="1" name="cant_cuotas" id="valor_cuota">
                                        </div>
                                        <div class="form-group">
                                          <label for="denominacion">Denominacion</label>
                                          <input type="text" class="form-control" name="denominacion" placeholder="Motivo..." id="denominacion">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">Cargar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-around" >
                    @if (Auth::user()->rol == 'admin')

                        <a href={{ route('Cobro.index', ['id'=>$user->id]) }} class="btn btn-danger">Cargar cobro</a>
                        
                    @else

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCargarCobro">
                            Cargar cobro
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="modalCargarCobro" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div>
                                        <form method="POST" action="{{ route('Cobro.store') }}" class="font-bold text-xl">
                                            @csrf
                                            <input type="hidden" name="userId" value="{{$user->id}}">
                                            <input type="hidden" name="cuentaId" value="2">
                                            <input type="hidden" name="tipoCobro" value="0">
                                            <div class="mb-2">
                                                <p>Cantidad de cuotas</p>
                                                <input type="number" name="cantCuotas" value="1">
                                            </div>
                                            <div class="mb-2">
                                                <p>Monto</p>
                                                <input type="number" name="monto" value="0">
                                            </div>
                                            <div class="mb-2">
                                                <p>Fecha</p>
                                                <input type="date" name="fecha" required>
                                            </div>
                                            <div >
                                                <input class="bg-red-800 text-white p-2 rounded" type="submit" value="Cargar">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </div>
                        </div>

                    @endif

                </div>
                
                <div class="d-flex justify-content-around mt-3" >
                    <a href={{ route('Cobranza.sendCuotaMail', ['id'=>$user->id, 'case' => 'php']) }} class="btn btn-danger">Enviar cupon de pago</a>
                </div>
            </div>
            <div class="col-md-6"  style="overflow: scroll;">
                <h3 class="text-dark">Historial de cobros</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>N° Operacion</th>
                            <th>Cuenta</th>
                            <th>Cant. cuotas</th>
                            <th>Monto</th>
                            <th>Tipo</th>
                            <th>Factura</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->cobros as $cobro)
                            
                        <tr>
                            <td scope="row">{{$cobro->id}}</td>
                            <td>{{$cobro->numero_operacion}}</td>
                            <td>{{$cobro->cuenta->name ?? 'Sin especificar'}}</td>
                            <td>{{$cobro->cant_cuotas}}</td>
                            <td>{{$cobro->monto}}</td>
                            @switch($cobro->tipo)
                                @case(0)
                                    <td>Cuota</td>
                                    @break
                                @case(1)
                                    <td>Cuota + Adicional</td>
                                    @break
                                @case(2)
                                    <td>Adicional</td>
                                    @break
                                @default
                                    
                            @endswitch                         
                            <td>{{$cobro->factura}}</td>
                            <td>{{$cobro->fecha}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      @else
        <div class="d-flex justify-content-around align-content-center text-center">
            <h4>No hay informacion de facturacion disponible :</h4>
        </div>
      @endif
        <a class="btn btn-info " href={{ route('Cobranza.formModificarInfoFac', ['user_id'=>$user->id]) }} >
            Cargar/Modificar
        </a>

    </div>
  </div>