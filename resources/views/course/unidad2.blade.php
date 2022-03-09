@extends('layouts.app')
@section('unidad')
@php
  use Carbon\Carbon;
@endphp

@if(session()->has('tpentregado'))
  <script>
      swal("Trabajo entregado", "El trabajo se encuentra en corrección, recibirá un email con su correspondiente nota cuando sea corregido", "success");
  </script>
@endif

<a class="btn btn-danger ml-2" title="Back" alt="Back" href="/VerCurso/{{$unidad->courses[0]->id}}"><-Volver</a> 
    @if (Auth::user()->rol == "admin" || Auth::user()->rol == "postventa")

      <div class="container">
          <div class="row justify-content-center">
              <div class="col-md-10">

                  <div class="card">
                      <div class="card-header bg-conf"><strong>{{$unidad->nombre}}</strong></div>
                      <div class="card-body">
                        <h4 class="text-center"><strong>Principales temas</strong> en la unidad</h4><br>
                        <p class="text-center">{{$unidad->descripcion}}</p>
                      </div>
                      <div class="container"><hr style="border-top: 1px solid #dedede;width: 60%;"></div><br>
                      <h2 class="text-center">MÓDULOS</h2><br>
                    <div class="container">
                          <p class="text-center text-secondary">En estos <strong>módulos</strong> el alumno encontrara diversas lecciones junto con sus explicaciones y ejercicios, siempre con el fin de fijar los conocimientos de una manera más eficáz.</p><br>
                      <div class="row justify-content-right">

                        {{--IMPRIMO LOS MODULOS DE LA UNIDAD--}}
                        @for($i = 0; $i < count($modules); $i++)
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-body bg-dark text-center">
                                <img height="100" src="img/pdf.png" />
                                <p style="font-size: 13px;margin-top:5px;" class="text-center"><a href="{{url($modules[$i]['url'])}}">Modulo N° {{$i+1}}.pdf</a></p>
                              </div>
                            </div>
                          </div>
                        @endfor


                      </div>
                    </div>

                    {{--imprimo los videos de yt de la unidad--}}
                    @if ($videosYT != null)
                      @foreach ($videosYT as $YT)
                        <div class="container"><hr style="border-top: 1px solid #dedede;width: 60%;"></div><br>
                        <h1 class="text-center">{{$YT->titulo}}</h1>
                        <div class="row justify-content-center">
                          <iframe width="560" height="315" src={{$YT->html}} frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                      @endforeach
                    @endif

                       <!-- row -->
                    <div class="container">
                      <h2 class="text-center">TRABAJOS PRÁCTICOS</h2>
                      <p class="text-center text-secondary">
                        Entregar en formato Word a <strong>worknowcursos@gmail.com</strong> ante 
                        cualquier duda consulte via whatsapp a su profesor a cargo al <strong>1126942226</strong>
                      </p>

                      <div class="row justify-content-right">

                        @for($i =0; $i<count($tps); $i++)

                          <div class="col-md-6">
                            <div class="card">
                              <div class="card-header">
                                <strong>Trabajo Práctico N°{{ $tps[$i]['numero']}}</strong>
                              </div>
                              <div class="card-body text-center">
                                <img height="100" src="img/tp.png" />
                                <p style="font-size: 13px;margin-top:8px;" class="text-center"><a href="{{ url($tps[$i]['url'])}}">TP N°{{$tps[$i]['numero']}}.pdf</a></p>
                                        <div class="alert alert-success"><strong>Aprobado</strong>  <img height="20" src="img/checked.png" /></div>
                              </div>
                            </div>
                      </div>

                        @endfor

                    </div> <!-- Container -->

                  </div>



      @for($i = 0; $i<count($exams); $i++)

                <div class="container"></div><br>
                <p class="text-center text-secondary">Una vez aprobados todos los trabajos prácticos tiene acceso para poder rendir las evaluaciones correspondientes para cada unidad. Recuerde que sólo puede realizarlas una sola vez. Por eso eliga un horario determinado del día donde tenga al menos 1 hora para dedicarle completamente a la evaluación sin interrupciones.</p><br>
                <div class="row justify-content-center">
                <a id="confirmation" href="{{ route('Exam.index', ['user_id' => Auth::user()->id, 'unity_id' => $unidad->id, 'exam_id' => $exams[$i]['id'] ]) }}" class="btn btn-success">Estoy preparado para rendir!</a>
                </div><br>

      @endfor
              </div>
          </div>
      </div>

      <footer class="footer">  </footer>



  @endif

    @if (Auth::user()->rol == "alumno")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-conf text-center text-light"><h4><strong>{{$unidad->nombre}}</strong></h4></div>
                <div class="card-body">
                  <h4 class="text-center"><strong>Principales temas</strong> en la unidad</h4><br>
                  <p class="text-center">{{$unidad->descripcion}}</p>
                </div>
                <div class="container"><hr style="border-top: 1px solid #dedede;width: 60%;"></div><br>
                <h2 class="text-center">MÓDULOS</h2><br>
              <div class="container">
                    <p class="text-center text-secondary">En estos <strong>módulos</strong> el alumno encontrara diversas lecciones junto con sus explicaciones y ejercicios, siempre con el fin de fijar los conocimientos de una manera más eficáz.</p><br>
                <div class="row justify-content-right">

                  {{--IMPRIMO LOS MODULOS DE LA UNIDAD--}}
                  @for($i = 0; $i < count($modules); $i++)
                    <div class="col-md-3">
                      <div class="card">
                        <div class="card-body text-center">
                          <img height="100" src="img/pdf.png" />
                          @if (Auth::user()->tipo_pago != 'test')
                              
                          <p style="font-size: 13px;margin-top:5px;" class="text-center"><a class="btn btn-success" href="{{$modules[$i]['url']}}">Modulo N° {{$i+1}}</a></p>
                          @else
                          @if ($i <= $unidad->courses[0]->courseTest->unities)
                              
                          <p style="font-size: 13px;margin-top:5px;" class="text-center"><a class="btn btn-success" href="{{$modules[$i]['url']}}">Modulo N° {{$i+1}}</a></p>
                          @else
                          <p style="font-size: 13px;margin-top:5px;" class="text-center">
                            <button type="button" class="btn btn-danger" data-bs-toggle="popover" title="Atencion!" data-content="No disponible en la version de prueba">Modulo N° {{$i+1}}</button>
                          </p>

                          @endif
      
                          @endif
                        </div>
                      </div>
                    </div>
                  @endfor


                </div></div><br>

                @if(!$videos->isEmpty())
                  <div class="container"><hr style="border-top: 1px solid #dedede;width: 60%;"></div><br>
                  <div class="container">
                  <h2 class="text-center">VIDEOS INFORMATIVOS</h2><br>
                  {{--IMPRIMO LOS VIDEOS DE LA UNIDAD--}}
                      @for($i = 0; $i < count($videos); $i++)
                        <div class="container mt-2">
                          <video id="my-video" class="video-js" controls preload="auto" width="100%" height="300" data-setup="{}">
                              <source src="{{$videos[$i]['url']}}" type='video/mp4'>
                          </video>
                        </div>
                      @endfor
                  </div>
                @endif
              </div>

              @if ($videosYT != null)
              {{--IMPRIMO LOS VIDEOS YT DE LA UNIDAD--}}
                @foreach ($videosYT as $YT)
                  <div class="container"><hr style="border-top: 1px solid #dedede;width: 60%;"></div><br>
                  <h1 class="text-center">{{$YT->titulo}}</h1>
                  <h5 class="text-center">{{$YT->subtitulo}}</h5>
                  <div class="row justify-content-center">
                    <iframe width="560" height="315" src={{$YT->html}} frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  </div>
                @endforeach
              @endif

                 <!-- row -->
                <hr>
                <div class="container mt-5">
                  <h2 class="text-center mb-5">TRABAJOS PRÁCTICOS</h2>
                  <p class="text-center text-secondary">
                    Entregar en formato Word a <strong>worknowcursos@gmail.com</strong> 
                    ante cualquier duda consulte via whatsapp a su profesor a cargo al <strong>1126942226</strong>
                  </p>
                  <div class="row justify-content-right">

                    @for($i =0; $i<count($tps); $i++)

                    <div class="col-md-6">
                      <div class="card mb-3">
                        <div class="card-header bg-conf">
                          <strong style="font-family: Arial;" >Trabajo Práctico N°{{$tps[$i]['numero']}}</strong>
                        </div>
                        <div class="card-body text-center">
                          <img height="100" src="img/tp.png" />

                          @if (Auth::user()->tipo_pago == 'test')
                            @if ($i < 1)
                              <p style="font-size: 13px;margin-top:8px;" class="text-center"><a class="btn btn-success" href="{{$tps[$i]['url']}}">TP N°{{$tps[$i]['numero']}}</a></p>
                                
                            @else
                              <p style="font-size: 13px;margin-top:8px;" class="text-center">
                                <button type="button" class="btn btn-danger" data-bs-toggle="popover" title="Atencion!" data-content="No disponible en la version de prueba">TP N°{{$tps[$i]['numero']}}</button>
                              </p>
        
                            @endif
                              
                          @else
                          <p style="font-size: 13px;margin-top:8px;" class="text-center"><a class="btn btn-success" href="{{$tps[$i]['url']}}">TP N°{{$tps[$i]['numero']}}</a></p>

                          @endif
                             
                             @php 
                                $bandera = 0;   
                              @endphp

                              @foreach($entregados as $entregado)
                                  @if($entregado->tp_id == $tps[$i]['id'])
                                      @php $bandera = 1;   @endphp
                                  @endif
                              @endforeach

                              @if($bandera == 1) {{-- Si el tp fue entregado --}}

                                  @for($p = 0; $p < count($entregados); $p++){{--CONTROLO EL ESTADO DEL TP--}}

                                    @if(($entregados[$p]['tp_id'] == $tps[$i]['id']) || ($entregados[$p]['tp_id'] == null))

                                      @if($entregados[$p]['nota'] == 'corrigiendo')
                                          <div class="alert alert-info"><strong>En corrección..</strong>  <img height="20" src="img/correccion.png" /></div>
                                          @php
                                              $bandera = 1;
                                              break;
                                          @endphp
                                      @elseif($entregados[$p]['nota'] == 'aprobado')
                                          <div class="alert alert-success"><strong>Aprobado con {{$entregados[$p]['nota_numerica']}}</strong>  <img height="20" src="img/checked.png" /></div>
                                          @php
                                              $bandera = 1;
                                              break;
                                          @endphp
                                      @elseif($entregados[$p]['nota'] == 'desaprobado')
                                          <div class="alert alert-danger"><strong>Desaprobado con {{$entregados[$p]['nota_numerica']}}</strong>  <img height="20" src="img/warn.png" /></div>
                                          @php $bandera = 0; @endphp
                                      @endif

                                    @endif

                                  @endfor

                              @endif

                              @if($bandera == 0)  {{--SI NO FUE ENTREGADO AUN--}}

                                <p class="text-secondary">
                                  Para que el docente evalúe su <strong>trabajo práctico</strong> 
                                  debe subir la <strong>resolución</strong> a continuación en un editor de texto.
                                </p>
                                
                                @if (Auth::user()->tipo_pago != 'test')
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Subir</span>
                                  </div>

                                  <div class="custom-file">
                                    
                                    <form class="form-control" action="{{ route('Tpresuelto.store', ['id'=> Auth::user()->id, 'tp_id' => $tps[$i]['id'], 'unity_id' => $unidad->id ]) }}" enctype="multipart/form-data" method="POST">
                                      @csrf
                                      
                                      <input type="file" name="tp" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                      <input id="input" class="custom-file-label text-left" for="inputGroupFile01" placeholder="Seleccionar archivo" style="width: 100%" />
                                      <input  type="submit" class="btn btn-conf mr-5 mb-5" value="Enviar resolución!">
                                    </form>

                                    <script>
                                          $(document).ready(function() {
                                              $('input[type="file"]').change(function() {
                                                  var val = ($(this).val()) ? $(this).val() : "No seleccionó ningún archivo!.";
                                                  $('#input').attr('placeholder', val);
                                              });
                                          });
                                    </script>
                                  </div>
                                </div>

                                <div class="alert alert-warning mt-5"><strong>Pendiente...</strong></div>
                                    
                                @else
                                <div class="alert alert-info mt-5"><p>Entrega no habilitada para la <strong>version de prueba</strong></p></div>   
                                @endif

                              @endif
                      </div>
                    </div>
                    
                  </div>
                  @endfor
                  @if (count($unidad->tpsVf) != 0)
                  <div class="alert alert-info w-100 text-center">
                    <h2>Verdadero/Falso</h2>
                  </div>
                  <hr style="border-top: 1px solid #dedede;width: 100%">
                  @foreach ($unidad->tpsVf as $index => $tp)
                    

                    <div class="col-6">
                    @if ($tp->score != null)
                        
                      @if (($tp->score->nota) > 7)
                      <div class="bg-success rounded text-center text-white p-2">Trabajo N°{{$index+1}} aprobado con <strong> {{$tp->score->nota}} </strong></div>  
                      
                      @elseif(strcmp(strtotime(date_format($tp->score->updated_at ,'Y-m-d')), strtotime(date('Y-m-d'))) !== 0)
                      
                      <a href="{{route('TpVf.show',['id'=>$tp->id])}}" class="btn btn-primary w-100">Verdadero/Falso N°{{$index+1}}</a>
                      @else

                      <div class="bg-danger rounded text-center p-2">Trabajo N°{{$index+1}} desaprobado, podra intentarlo nuevamente mañana</div>  
                      @endif

                    @else
                      <a href="{{route('TpVf.show',['id'=>$tp->id])}}" class="btn btn-primary w-100">Verdadero/Falso N°{{$index+1}}</a>
                    @endif
                    </div>
                  @endforeach
                      
                  @endif


</div> <!-- Container -->

            </div>
            </div>


            @php
              $TpsAprobados = 0;
              $TpsDesaprobados = 0;
              $TpsCorrigiendo = 0;
              $entregados = 0;
            @endphp



          @for($i =0; $i<count($tps); $i++)
            @for($x=0; $x<count($notas);$x++)
              @if($tps[$i]['id'] == $notas[$x]['id'])
                @for($p = 0; $p < count($notas[$x]['scores']); $p++)
                  @if (($notas[$x]['scores'][$p]['user_id'] == Auth::user()->id) && ($notas[$x]['scores'][$p]['nota'] != 'desaprobado'))
                    @php $entregados++; @endphp
                    @if($notas[$x]['scores'][$p]['nota'] == 'aprobado' && $notas[$x]['scores'][$p]['user_id'] == Auth::user()->id)
                      @php    $TpsAprobados++; @endphp
                    @endif
                  @endif
                @endfor
              @endif
            @endfor
          @endfor



<br>

<div class="container"><hr style="border-top: 1px solid #dedede;width: 60%;"></div><br>
<div class="container">
   <h2 class="text-center">EVALUACIÓN</h2>
@if( (count($tps) <= $entregados) && ($TpsAprobados == (count($tps))) && ($entregados > 0)) {{-- SI ESTAN TODOS APROBADOS --}}





<div class="row justify-content-right">
  
  @foreach ($unidad->tpsFinals as $tpFinal)

  @php
      $tpFinalEstado = null;
      foreach ($tpFinal->resoluciones as $resolucion){

        if ($resolucion->user_id == Auth::user()->id){

          $tpFinalEstado = $resolucion;
          break;
        }
      }

  @endphp

    <div class="col-6">
      <div class="card mt-3">
        <div class="card-header font-weight-bolder text-white bg-danger ">
          Trabajo Practico Final
        </div>
        <div class="card-body">
          <p class="text-center text-secondary">Una vez aprobados todos los trabajos prácticos tiene 
                                              acceso para poder el trabajo final de la unidad.
          </p><br>
          <div class="row justify-content-center">
            <a id="confirmation" href={{$tpFinal->url}} class="btn btn-info">TP Final</a>
          </div>
          <div class="custom-file">
            @if ($tpFinalEstado == null)
                 
            <form class="form-control" action={{ route('cargarTpFinal')}} enctype="multipart/form-data" method="POST">
              @csrf
              <input type="hidden" name="user_id" value={{Auth::user()->id}}>
              <input type="hidden" name="tpFinalId" value={{$tpFinal->id}}>
              <input type="file" name="tpFinal" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
              <input id="inputTpFinal" class="custom-file-label text-left" for="inputGroupFile01" placeholder="Seleccionar archivo" style="width: 100%" />
              <input  type="submit" class="btn btn-conf mr-5 mb-5" value="Enviar resolución!">
            </form>
            @else

            <div class="alert alert-success">{{$tpFinalEstado->estado}} </div>
            @endif                       
            <script>
                  $(document).ready(function() {
                      $('input[type="file"]').change(function() {
                          var val = ($(this).val()) ? $(this).val() : "No seleccionó ningún archivo!.";
                          $('#inputTpFinal').attr('placeholder', val);
                      });
                  });
            </script>
          </div>
        </div><br>
    </div>
    </div>
  @endforeach


    @for($i = 0; $i<count($exams); $i++)
    @php $bandera2 = 0; @endphp
    
        
        @if(count($exams[$i]['scoreExams']) != 0 )  {{--osea q ya hizo el examen --}}
          @php $bandera2++; @endphp                 {{--sumo uno a la bandera--}}

        @endif
        
      @if($bandera2 == 0) {{--si es 0 quiere decir q no hizo nunca el examen--}}
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              
              <p class="text-center">Examen N° {{$exams[$i]['numero']}}</p>
            </div>
            <div class="card-body">
              <p class="text-center text-secondary">Una vez aprobados todos los trabajos prácticos tiene 
                                                  acceso para poder rendir las evaluaciones correspondientes 
                                                  para cada unidad. Recuerde que sólo puede realizarlas una sola vez. 
                                                  Por eso eliga un horario determinado del día donde tenga al menos 1 
                                                  hora para dedicarle completamente a la evaluación sin interrupciones.
              </p><br>
              <div class="row justify-content-center">
                <a id="confirmation" href="{{ route('Exam.index', ['user_id' => Auth::user()->id, 'unity_id' => $unidad->id, 'exam_id' => $exams[$i]['id'] ]) }}" class="btn btn-success">Estoy preparado para rendir!</a>
              </div>
            </div><br>
        </div>
      </div>
      @else
      @for ($x = 0; $x < count($exams[$i]['scoreExams']); $x++)
          

          @if($exams[$i]['scoreExams'][$x]['nota'] == 'aprobado')
            <div class="col-md-6">
              <div class="card">
                <div class="card-header bg-success">
                  <h3 class="text-center">Examen N° {{$exams[$i]['numero']}} </h3>
                </div>
                <div class="card-body">
            <div class="alert alert-success text-center">Examen <strong>aprobado</strong> con éxito <img height="20" src="img/checked.png" /> </div>
          </div></div></div>

          @elseif($exams[$i]['scoreExams'][$x]['nota'] == 'desaprobado') 
            @php
              $resuelto = new Carbon($exams[$i]['scoreExams'][$x]['created_at']);

              $resuelto->day = $resuelto->day+10;
              $resuelto = $resuelto->format('d-m-Y');
              $hoy = Carbon::now();
              $hoy = $hoy->format('d-m-Y');
              $hoy = strtotime($hoy);
              $fechaResolucion = strtotime($resuelto);
            @endphp
            
              @if($hoy >= $fechaResolucion)
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <p class="text-center">Examen N° {{$exams[$i]['numero']}}</p>
                    </div>
                    <div class="card-body">
                      <p class="text-center text-secondary">Una vez aprobados todos los trabajos prácticos tiene acceso para poder rendir las evaluaciones correspondientes para cada unidad. Recuerde que sólo puede realizarlas una sola vez. Por eso eliga un horario determinado del día donde tenga al menos 1 hora para dedicarle completamente a la evaluación sin interrupciones.</p><br>
                      <div class="row justify-content-center">
                        <a id="confirmation" href="{{ route('Exam.index', ['user_id' => Auth::user()->id, 'unity_id' => $unidad->id, 'exam_id' => $exams[$i]['id'] ]) }}" class="btn btn-success">Estoy preparado para rendir!</a>
                      </div>
                    </div>
                  </div>
                </div>
</div>

              @else
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <p class="text-center">Examen N° {{$exams[$i]['numero']}}</p>
                    </div>
                    <div class="card-body">
                      <p class="text-center">El recuperatorio es a partir del día: <strong> {{$resuelto}} !!</strong></p>
                <div class="alert alert-danger text-center">Examen <strong>DESAPROBADO</strong> <img height="20" src="img/warn.png" /> </div>

                </div></div></div>
              @endif
          @endif
          @endfor
      @endif
  @endfor


</div>
</div>
</div>
</div>

@else
  <div class="alert alert-danger text-center">Debe aprobar todos los trabajos prácticos para poder rendir el exámen.</div>
@endif


        </div>
    </div>


<div id="inferior" class="container">
  <div class="row justify-content-center" style="margin-right: 70px; margin-bottom: 40px;" >
    <a href="https://api.whatsapp.com/send?phone=5491126942226&text=Tengo%20una%20duda%20sobre%20el%20aula%20virtual%20y%20los%20cursos!%20"><img id="img" src="/img/whatsapp.png" ></a>
  </div>
</div>

<style type="text/css">
body,html{
height:100%; /*Siempre es necesario cuando trabajamos con alturas*/
}
 #inferior{
color: #FFF;
margin: 0 !important;
    padding: 0 !important;
    position: fixed !important;
    z-index: 16000160 !important;
    bottom: 0 !important;
    text-align: center !important;
    width: 60px;
    visibility: visible;
    transition: none !important;
    right:0;
    margin-left: 10px;

 }
</style>

<style>
@media (min-width: 1281px) {

  #img{
    height: 80px;
  }

}
</style>

<style>
@media (min-width: 320px) and (max-width: 480px) {

  #img{
    height: 50px;
  }

}
</style>
<a class="btn btn-danger ml-2" title="Back" alt="Back" href="/VerCurso/{{$unidad->courses[0]->id}}"><-Volver</a> 
<footer class="footer">  </footer>

  @endif

<script>
  $(function () {
    $('[data-bs-toggle="popover"]').popover()
  })
</script>
@endsection
