@extends('layouts.app')

@section('correction')

  @if(session()->has('success'))
    <script>
        swal("Trabajo aprobado", "El trabajo se aprobó con exito", "success");
    </script>
  @endif

  @if(session()->has('danger'))
    <script>
        swal("Trabajo desaprobado", "El trabajo se desaprobó con exito", "error");
    </script>
  @endif

  @if (count($TpsFinals) != 0 )
  <div class="alert alert-info">
    <h4>Tps Finales</h4>
  </div>
      <table class="table">
        <thead>
          <th>Usuario</th>
          <th>Unidad</th>
          <th>Curso</th>
          <th>Fecha entrega</th>
          <th>Donwload</th>
          <th>Accion</th>
        </thead>
        <tbody>
          @foreach ($TpsFinals as $TpF)
          <tr>
            <td scope="row">
              <a href={{route('User.modificarAlumno', ['id' => $TpF->user->id])}} >{{$TpF->user->name}}</a>  
            </td>
            <td>{{$TpF->tpFinal->unity->nombre}} </td>
            <td>{{$TpF->tpFinal->unity->courses[0]->nombre}}</td>
            <td>{{date_format($TpF->created_at, 'd-m-Y')}} </td>
            <td><a class="btn btn-warning" href="{{route ('Tpresuelto.download', ['url' => $TpF->url])}}"> Descargar</a></td>
            <td>
              <a href={{route('Score.corregirTpFinal', ['tpFinal_id'=> $TpF->id, 'id' => $TpF->user->id, 'resultado' =>'aprobado' ])}}  class="btn btn-success">Aprobar</a>
              <a href={{route('Score.corregirTpFinal', ['tpFinal_id'=> $TpF->id, 'id' => $TpF->user->id, 'resultado' =>'desaprobado' ])}} class="btn btn-danger">Desaprobar</a>
            </td>

          </tr>
              
          @endforeach
        </tbody>
      </table>

  @endif
  <div class="alert alert-info">
    <h5>Tps</h5>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Usuario</th>
        <th scope="col">Fecha ingreso</th>
        <th scope="col">TP</th>
        <th scope="col">Unidad Numero</th>
        <th scope="col">Curso</th>
        <th scope="col">Fecha de entrega</th>
        <th scope="col">Link del Trabajo Practico</th>
        <th scope="col">Accion</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
      @for($i = 0; $i < count($TpsEntregados); $i++)

          @if ($TpsEntregados[$i]['score'] != null)
            @if($TpsEntregados[$i]['score']['nota'] == 'corrigiendo')
            <tr>
              <th scope="row">{{$i}}</th>
              <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal{{$TpsEntregados[$i]['user_id']}}">
                  {{$TpsEntregados[$i]['user']['name']}}
                </button>
              </td>

{{--INICIO MODAL--}}
              <div class="modal fade" id="userModal{{$TpsEntregados[$i]['user_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <div class="flex justify-between w-full">
                        <h5 class="modal-title" id="exampleModalLabel">Alumno {{$TpsEntregados[$i]['user_id']}}</h5>
                        <div class="h-20">

                          <img src={{ asset('img/lupa.jpg') }} class="max-h-full" alt="Lupa">
                        </div>
                      </div>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="card">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item"><strong>N° Alumno:  </strong><a href={{route('User.modificarAlumno', ['id' => $TpsEntregados[$i]['user']['id']])}}>{{$TpsEntregados[$i]['user']['id']}}</a> </li>
                          <li class="list-group-item"><strong>Nombre:  </strong>{{$TpsEntregados[$i]['user']['name']}}</li>
                          <li class="list-group-item"><strong>E-mail:  </strong>{{$TpsEntregados[$i]['user']['email']}}</li>
                        </ul>
                      </div>                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
{{--END MODAL--}}
              <td>{{date_format($TpsEntregados[$i]['user']['created_at'], "d-m-Y")}}</td>
               @for($x = 0; $x < count($tps); $x++)
                @if($TpsEntregados[$i]['tp_id'] == $tps[$x]['id'])
                    <td> <a class="btn btn-info" href="{{$tps[$x]['url']}}">TP N{{$tps[$x]['numero']}}</a>
                       @for($y = 0; $y < count($cursos); $y++)
                           @for($p = 0; $p < count($cursos[$y]['unities']); $p++)
                                @if($tps[$x]['unity_id'] == $cursos[$y]['unities'][$p]['id'])
                                    <td><a href="/Unidad?id={{$cursos[$y]['unities'][$p]['id']}}">{{$cursos[$y]['unities'][$p]['nombre']}}</a></td>
                                    <td><a href="/VerCurso/{{$cursos[$y]['id']}}">{{$cursos[$y]['nombre']}}</a></td>
                                @endif
                           @endfor
                       @endfor

                @endif
              @endfor
              
              <td>{{date_format($TpsEntregados[$i]['created_at'], "d-m")}}</td>
              <td><a class="btn btn-warning" href="{{route ('Tpresuelto.download', ['url' => $TpsEntregados[$i]['url']])}}"> Descargar </a></td>
              <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#correctionModal{{$TpsEntregados[$i]['user_id']}}">
                  Corregir
                </button>
              </td>
              <td>
                  <a onclick="javascript:return confirm('Estas a punto de eliminar una entrega, ¿Estas seguro?');" 
                      class="btn btn-danger" 
                      href="{{route ('Tpresuelto.borrarResuelto', ['id' => $TpsEntregados[$i]])}}"
                  > Eliminar </a>
              </td>
        {{--INICIO MODAL--}}
              <div class="modal fade" id="correctionModal{{$TpsEntregados[$i]['user_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <div class="flex justify-between w-full">
                        <h5 class="modal-title text-2xl" id="exampleModalLabel">{{$TpsEntregados[$i]['user']['name']}}</h5>
                        <div class="h-20">

                          <img src={{ asset('img/lupa.jpg') }} class="max-h-full" alt="Lupa">
                        </div>
                      </div>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="card p-3">
                        <h4>Se aprueba con 7 o mas</h4>
                        <form action={{route('Score.aprobar', [
                                                                'tpresuelto_id'=>$TpsEntregados[$i]['id'] ,
                                                                'user_id' => $TpsEntregados[$i]['user_id'], 
                                                                'tp_id' => $TpsEntregados[$i]['tp_id'], 
                                                                'id_score' => $TpsEntregados[$i]['score']['id']
                                                              ])}}
                              method="POST"
                        >
                          @csrf
                          <input type="hidden" name="tpresuelto_id" value={{$TpsEntregados[$i]['id']}} >
                          <input type="hidden" name="user_id" value={{$TpsEntregados[$i]['user_id']}} >
                          <input type="hidden" name="tp_id" value={{$TpsEntregados[$i]['tp_id']}} >
                          <input type="hidden" name="id_score" value={{$TpsEntregados[$i]['score']['id']}} >
                          <div class="form-group">
                            <label for="exampleInputEmail1">Nota numerica</label>
                            <input type="number" step="0.01" class="form-control" name="nota_numerica" aria-describedby="notaHelp" placeholder="Ingrese la nota..." required>
                            <small id="notaHelp" class="form-text text-muted">Se aceptan hasta 2 decimales</small>
                          </div>
                          <div class="form-group">
                            <textarea name="msj" id="msjHelp" cols="50" rows="5" placeholder="Mensaje a enviar (opcional)"></textarea>
                            <small id="msjHelp" class="form-text text-muted">El mensaje aparecera en el correo de correccion</small>
                          </div>
                          <input type="submit" value="Cargar" class="btn btn-primary">
                        </form>
                      </div>                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
        {{--END MODAL--}}
              {{--
                <td><a href="{{route('Score.aprobar', ['tpresuelto_id'=>$TpsEntregados[$i]['id'] ,'user_id' => $TpsEntregados[$i]['user_id'], 'tp_id' => $TpsEntregados[$i]['tp_id'], 'id_score' => $TpsEntregados[$i]['scores'][0]['id']])}}"  class="btn btn-success">Aprobar</a>
                  <a href="{{route('Score.desaprobar', ['user_id' => $TpsEntregados[$i]['user_id'], 'tp_id' => $TpsEntregados[$i]['tp_id'], 'id_score' => $TpsEntregados[$i]['scores'][0]['id']])}}" class="btn btn-danger">Desaprobar</a></td>
                  --}}

            </tr>
          @endif
          @endif
        
      @endfor
    </tbody>
  </table>

  <div class="text-center"><a href="/postventa" class="btn btn-danger">Volver</a></div>



@endsection
