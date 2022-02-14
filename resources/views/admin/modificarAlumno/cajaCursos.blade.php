<div class="card bg-dark">
    <div class="card-header bg-info font-weight-bolder">
      Informacion de cursos
    </div>
    <div class="card-body p-1">
      <button type="button" class="btn btn-block btn-dark" data-toggle="modal" data-target="#modalCorreccion">Ver entregas</button>
        {{--INICIO MODAL CORRECCION--}}
        <div class="modal fade  " id="modalCorreccion" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog mw-100 w-70 mr-3 ml-3" role="document">
            <div class="modal-content ">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Correcciones pendientes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body w-100">
                @if (count($user->scoreCorrection) == 0)
                    <div class="alert alert-info">
                      <p>No hay correcciones pendientes</p>
                    </div>
                @endif
                <table class="table">
                  <thead>
                    <tr>
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

                  @foreach ($user->scoreCorrection as $score)
                      <tr>
                        <td scope="row"><a class="btn btn-info" href="{{$score->tp->url}}">Tp{{$score->tp->numero}}</a> </td>
                        <td>{{$score->tp->unity->nombre}}</td>
                        <td>{{$score->tp->unity->courses[0]->nombre}}</td>
                        <td>{{date_format($score->created_at, "d-m")}}</td>
                        <td><a class="btn btn-warning" href="{{route ('Tpresuelto.download', ['url' => $score->tpResuelto->url])}}"> Descargar </a></td>
                        <td>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#correctionModal{{$score->id}}">
                            Corregir
                          </button>
                        </td>
                        <td><a onclick="javascript:return confirm('Estas a punto de eliminar una entrega, ¿Estas seguro?');" class="btn btn-danger" href="{{route ('Tpresuelto.borrarResuelto', ['id' => $score->tpResuelto->id])}}"> Eliminar </a></td>

                      </tr>

                      {{--INICIO MODAL CARGAR NOTA--}}
                      <div class="modal fade" id="correctionModal{{$score->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <div class="d-flex">
                                <h5 class="modal-title" id="exampleModalLabel">{{$user->name}}</h5>
                                <img src={{ asset('img/lupa.jpg') }} height="40px" alt="Lupa">
                              </div>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="card p-3">
                                <h4>Se aprueba con 7 o mas</h4>
                                <form action={{route('Score.aprobar', [
                                                                        'tpresuelto_id'=>$score->tpResuelto->id ,
                                                                        'user_id' => $user->id, 
                                                                        'tp_id' => $score->tpResuelto->tp_id, 
                                                                        'id_score' => $score->id
                                                                      ])}}
                                      method="POST"
                                >
                                  @csrf
                                  <input type="hidden" name="tpresuelto_id" value={{$score->tpResuelto->id}} >
                                  <input type="hidden" name="user_id" value={{$user->id}} >
                                  <input type="hidden" name="tp_id" value={{$score->tpResuelto->tp_id}} >
                                  <input type="hidden" name="id_score" value={{$score->id}} >
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
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      {{--END MODAL CARGAR NOTA--}}

                  @endforeach
                </tbody>
              </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        {{--END MODAL CORRECCION--}}
    </div>{{--Cierre card-body--}}

   
        <ul class="list-group">
            @foreach ($user->courses as $course)
                <li class="list-group-item d-flex justify-content-between">

                  

                    <a target="_blank" href="/VerCurso/{{$course->id}}">{{$course->nombre}}</a>
                    @if ($course->recibido($user->id) == null)

                    <a  href="{{route('Admin.sendDiploma', [
                                                      'user_id' => $user->id, 
                                                      'course_id' => $course->id]) }}"
                        class="btn btn-primary btn-sm">Entregar Diploma</a> 
                    @else
                    <a  onclick="javascript: return confirm('Seguro que desea eliminar el diploma?')"
                        href="{{route('Admin.deleteDiploma', ['Recibido' => $course->recibido($user->id)]) }}"
                        class="btn btn-dark btn-sm">Eliminar Diploma</a> 
                    @endif
                    <a 
                              href="{{route('Curso.baja', [
                                                            'user_id' => $user->id, 
                                                            'course_id' => $course->id]) }}"
                              class="btn btn-danger btn-sm"
                    >Dar de baja
                    </a> 
                    <form method="POST" action="{{route('Course.setType',['course'=>$course,'user_id'=>$user->id])}}" class="flex justify-between">
                      @csrf
                      <select class="bg-blue-300" name="type" id="">
                        <option value="{{$course->pivot->type}}">{{$course->pivot->type}}</option>
                        <option value="test">Test</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="total">Total</option>
                      </select>
                      @if ($course->pivot->type == 'efectivo')
                          <input type="number" name="unities" class="w-10" value="{{$course->pivot->unities}}">
                      @endif
                      <input class="px-1" type="submit" value="Cargar">
                    </form>
                    

                    <a type="button" data-toggle="modal" data-target="#a{{$course['id']}}" style="color:white;" class="btn btn-success btn-sm">Aprobar Tps</a>
                      
                        {{--INICIO MODAL TPS--}}
                          <div class="modal fade" id="a{{$course['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog mw-100 m-5" role="document">
                              <div class="modal-content border border-primary">
                                <div class="modal-header bg-primary text-white font-weight-bolder">
                                  <h5 class="modal-title" id="exampleModalLabel">{{$course['nombre']}}</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    @foreach ($course->unities as $unity)
                    
                                    <div class="col-md-6">
                                      <div class="card mb-2">
                                        <div class="card-header bg-info">
                                          <p><strong>{{$unity['nombre']}}</strong></p>
                                        </div>
                                        @if (count($unity->tpsFinals) != 0)
                                            
                                          <h5 class="font-weight-bolder m-3">Tps Finales</h5>
                                          @foreach ($unity->tpsFinals as $TpF)
                                            <div class="row">
                                              <div class="col-12">
                                                <a target="_blank" href="{{$TpF->url}}"> <span class="bg-danger m-2 p-1 text-white font-weight-bolder">Ver </span></a>
                                                  
                                                @php
                                                    $flag = 0;
                                                @endphp
                                                @foreach ($TpF->resoluciones as $resolucion)
                                                    @if ($resolucion->user_id == $user->id)
                                                        @php
                                                            $flag = 1;
                                                        @endphp
                                                        <span style="color:#088A08; margin-left:10px; font-weight: bolder ">

                                                          {{$resolucion->estado}}
                                                        </span>
                                                        @break
                                                    @endif
                                                @endforeach
                                                @if ($flag == 0)
                                                  <a class="btn btn-success" href={{route('Score.corregirTpFinal', ['TpF_id'=> $TpF->id, 'resultado' =>'aprobado', 'user_id' => $user->id ])}}>
                                                    Aprobar
                                                  </a> 
                                                @endif
                                              </div>
                                            
                                            
                                            </div>
                                          @endforeach
                                        <hr>
                                        @endif
                                        
                                        <div class="card-body">
                                          <h5 class="font-weight-bolder">Tps</h5>

                                            @foreach ($unity->tps as $tp)  
                                              <div class="row">
                                                  <div class="col">
                                                      <a target="_blank" href="{{$tp['url']}}"><p>TP N° <strong>{{$tp['numero']}}</strong></a> 
                                                  </div>

                                                  <div class="col-6">
                                                      <form action={{route('Tp.aprobar')}} method="get">
                                                          @if ($tp->scoreUser($user->id) != null)
                                                              
                                                            @if($tp->scoreUser($user->id)['nota'] == 'aprobado')
                                                            <span class="text-success"><strong>{{$tp->scoreUser($user->id)['nota']}}</strong></span>
                                                            @elseif ($tp->scoreUser($user->id)['nota'] == 'desaprobado')
                                                            <span class="text-danger"><strong>{{$tp->scoreUser($user->id)['nota']}}</strong></span>
                                                            @endif
                                                          @endif
                                                          <input type="hidden" name="tp_id" value={{$tp['id']}}> 
                                                          <input type="hidden" name="user_id" value={{$user->id}}>
                                                          <input type="hidden" name="score_id" value={{$tp->scoreUser($user->id)->id ?? null}}>
                                                         
                                                          <input type="number" style="width:50px;" step="0.01" name="nota_numerica" value={{$tp->scoreUser($user->id)->nota_numerica ?? ""}} >
                                                          <input class="btn btn-outline-success btn-sm" type="submit" value="Cargar">
                                                      </form>

                                                  </div>
                                              </div>
                                              <hr>
                                            @endforeach
                                            <hr>
                                            @foreach ($unity->tpsVf as $vf)
                                                @if (count($vf->score($user->id)) != 0)
                                                    
                                                <div class="row">
                                                <div class="col-6">
                                                    <h5>Tp {{$vf->score($user->id)[0]->tp_id}}</h5>
                                                </div>
                                                <div class="col-6">
                                                    <h3 class="badge badge-success">{{$vf->score($user->id)[0]->nota}} </h3>
                                                </div>
                                                </div>
                                                @endif
                                            @endforeach
                                            </div>
                                        </div>
                                      
                                      </div>
                                    @endforeach
                                      
                                  </div>{{--CIERRE MODAL-BODY--}}
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Listo!</button>
                                </div>
                          </div>
                    
                </li>
            @endforeach{{--FOREACH DE CURSOS--}}
            <li class="list-group-item">
              <button type="button" class="btn btn-outline-primary btn-block" data-toggle="collapse" data-target="#collapseCursos">Agregar Cursos</button>
            </li>
            
        </ul>
    </div>
</div>