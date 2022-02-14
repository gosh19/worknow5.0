@extends('layouts.app')

@section('curso')

{{--HACER VERIFICACION DE USUARIO PARA CURSO --}}
<a class="btn btn-danger ml-2" title="Back" alt="Back" href="/"><-Volver</a> 
@php
  $bandera = 0;
@endphp

@foreach ($cursos as $cur)
  @if(($cur['pivot']['user_id'] == Auth::user()->id) || (Auth::user()->rol == "admin") || (Auth::user()->rol == "postventa"))
@if ($bandera == 0)
    @php
      $bandera = 1;
    @endphp
@endif
@endif
@endforeach

@if($cursos->isEmpty() && ((Auth::user()->rol == "admin") || (Auth::user()->rol == "postventa")))
  @php
    $bandera = 1;
  @endphp
@endif

@if($bandera == 1)

  @if (Auth::check())
    @if ((Auth::user()->rol == "admin") || (Auth::user()->rol == "postventa"))

      <div class="container">
        <div class="row justify-content-center">
          
          <div class="col-md-10">
            <div class="card">
              <div class="card-header bg-conf text-center">
                <strong>Curso de {{$curso->nombre}} </strong>
              </div>
              <div class="card-body">
                <div class="row justify-content-center">
                  <div class="alert alert-warning">Ingresa al <strong><a href="{{ url($curso->url_temario)}}">temario</a></strong> para saber mas sobre lo que aprenderás en toda tu cursada. <a><img height="35" src="/img/pdf.png" /></a></div>
                </div>
                <div class="row justify-content-right">

      @for($i = 0; $i < count($unidades); $i++)
                        <div class="col-md-4">
                          <div class="card">
                            <div class="card-header">
                              <strong>{{$unidades[$i]['nombre']}}</strong>
                            </div>
                            <div class="card-body text-secondary ">
                              <p>● Trabajos Prácticos:

                                  @for($t = 0; $t<count($tps); $t++)
                                    @if($tps[$t]['id'] == $unidades[$i]['id'])
                                        <span class="text-success"><strong>1 / 1</strong><img height="25" src="/img/checked.png" /></span></p>
                                        <p>● Evaluaciones: <a href="#" class="text-success"><strong><i>Disponible</i></strong></a></p>
                                    @endif
                                  @endfor

                            <!--  <div class="alert alert-success">Unidad<strong> Completada</strong></div>-->
                              <div class="text-center"><a class="btn btn-danger text-white " href="{{ route('Unidad.index', ['id' => $unidades[$i]['id']])}}">Ver Unidad</a></div>
                              </div>
                            </div>
                          </div>

      @endfor

      

                          </div>
                      </div>
                  </div>
              </div>
          </div>

    @endif
  @endif

  @if (Auth::check())
    @if (Auth::user()->rol == "alumno")

<div class="container">
  <div class="row justify-content-center">

    <div class="col-md-10">
      <div class="card">
        <div class="card-header text-center bg-conf text-light" id="tip">
          <h4><strong>Curso de {{$curso->nombre}} </strong></h4>
          @if ($tip != null)
            
          <span>
            Tip
            <a onclick="mostrarTip()" id="tip" tabindex="0" data-delay="100" class="btn btn-danger" role="button" data-toggle="popover" data-trigger="focus" title="Tip #{{$tip->id}}" data-content="{{$tip->texto}}" >
              <img width="25px" src={{asset('img/checked.png')}} alt="">
            </a>
          </span>
          @endif
        </div>
        <div class="card-body ">
          <div class="row justify-content-center">
            <div class="alert alert-warning">Ingresa al <strong><a href="{{ url($curso->url_temario)}}">temario</a></strong>  para saber mas sobre lo que aprenderás en toda tu cursada. <a><img height="35" src="/img/pdf.png" /></a></div>
          </div>
          <div class="row justify-content-right" >
            

@if ((Auth::user()->tipo_pago != "efectivo")&&(Auth::user()->tipo_pago != "test"))
    

@for($i = 0; $i < count($unidades); $i++)

                  <div class="col-md-4 mb-4" >
                    <div class="card">
                      <div class="card-header bg-conf text-white text-center">
                        <strong style="font-family: Arial !important;">Unidad {{$i+1}} - {{$unidades[$i]['nombre']}}</strong>
                      </div>
                      <div class="card-body text-secondary ">
                        <p>● Trabajos Prácticos:
                          @php
                            $aprobados = 0;
                          @endphp

                          @for($x=0; $x<count($entregados); $x++)
                            @if($unidades[$i]['id'] == $entregados[$x]['unity_id'])
                              @for($z=0; $z<count($entregados[$x]['scores']); $z++)
                                @if($entregados[$x]['scores'][$z]['user_id'] == Auth::user()->id && $entregados[$x]['scores'][$z]['nota'] == 'aprobado')
                                  @php
                                    $aprobados++;
                                  @endphp
                                @endif
                              @endfor
                            @endif
                          @endfor

                          @if (count($unidades[$i]->tpsVf) != 0)
                            @foreach ($unidades[$i]->tpsVf as $tpVf)
                                
                            @if ($tpVf->score != null)
                                @if ($tpVf->score->nota >= 7)
                                @php
                                    $aprobados++;
                                @endphp
                                @endif
                            @endif
                            @endforeach
                          @endif


                            @for($t = 0; $t<count($tps); $t++)
                              @if($tps[$t]['id'] == $unidades[$i]['id'])

                                @if($aprobados == (count($tps[$t]['tps']) + count($unidades[$i]->tpsVf)))
                                  @if(count($tps[$t]['tps']) == 0)
                                    <span class="text-danger"><strong>{{$aprobados}} / {{count($tps[$t]['tps']) + count($unidades[$i]->tpsVf)}}</strong><img height="25" src="/img/warn.png" /></span></p>
                                    <p>● Evaluaciones: <a href="#" class="text-danger"><strong><i>No disponible</i></strong></a></p>
                                    <div class="alert alert-danger text-center">Unidad <strong><i>no disponible</i></strong></div>
                                  @else

                                    <span class="text-success"><strong>{{$aprobados}} / {{count($tps[$t]['tps']) + count($unidades[$i]->tpsVf)}}</strong><img height="25" src="/img/checked.png" /></span></p>
                                    <p>● Evaluaciones: <a href="#" class="text-success"><strong><i>Disponible</i></strong></a></p>
                                  @endif
                                @endif

                                @if($aprobados != (count($tps[$t]['tps'])  + count($unidades[$i]->tpsVf)))

                                <span class="text-danger"><strong>{{$aprobados}} / {{count($tps[$t]['tps']) + count($unidades[$i]->tpsVf)}}</strong><img height="22" src="/img/warn.png" /></span></p>
                                <p>● Evaluaciones: <span class="text-danger"><strong><i>Finalizar TP's</i></strong></span></p>
                                @endif

                              @endif
                            @endfor
                            <p>● Promedio actual: <span class="text-danger"><strong><i>{{$unidades[$i]['promedio']}}</i></strong></span></p>





                      <!--  <div class="alert alert-success">Unidad<strong> Completada</strong></div>-->
                        <div class="text-center d-flex justify-content-center">
                          <a class="btn btn-conf text-white " href="{{ route('Unidad.index', ['id' => $unidades[$i]['id']])}}">Ver Unidad</a> 
                          @if ($unidades[$i]['notification'] != 0)
                            <img style="height:40px" src={{ asset('img/notification-bell.png') }}>
                            <div 
                              style="height: 30px;width: 30px;border-radius:20px;font-weight:bold;" 
                              class="bg-danger text-center text-white p-1"
                            >
                              {{$unidades[$i]['notification'] ?? 0}}
                            </div>
                          @endif
                        </div>
                        </div>
                      </div>
                    </div>

@endfor

@else {{--EN CASO DE SER EFECTIVO TOMARA UN NUMERO DE CANTIDAD DE UNIDADES DISPONIBLES DE LA BD--}}

  @if (Auth::user()->tipo_pago == "efectivo")
      
      @php
          $unidades_habilitadas = Auth::user()->unities_habilitadas;
          if (count($unidades) < $unidades_habilitadas){
            $unidades_habilitadas = count($unidades);
          }
      @endphp

  @if (count($unidades) > $unidades_habilitadas)
      <div class="alert alert-danger ml-5 mr-5">
        <p>Se le habilitaran las unidades a medida que avance con el curso, ante cualquier duda recuerde consultar por <strong> Whatsapp</strong></p>
      </div>
  @endif
  @for($i = 0; $i < count($unidades); $i++)

  <div class="col-md-4 mb-4">
    <div class="card">
      <div class="card-header bg-conf text-white text-center">
        <strong style="font-family: Arial !important;">Unidad {{$i+1}} - {{$unidades[$i]['nombre']}}</strong>
      </div>
      <div class="card-body text-secondary ">
        <p>● Trabajos Prácticos:
          @php
            $aprobados = 0;
          @endphp

          @for($x=0; $x<count($entregados); $x++)
            @if($unidades[$i]['id'] == $entregados[$x]['unity_id'])
              @for($z=0; $z<count($entregados[$x]['scores']); $z++)
                @if($entregados[$x]['scores'][$z]['user_id'] == Auth::user()->id && $entregados[$x]['scores'][$z]['nota'] == 'aprobado')
                        @php
                            $aprobados++;
                        @endphp
                @endif
            @endfor
            @endif
        @endfor
        
        @if (count($unidades[$i]->tpsVf) != 0)
          @foreach ($unidades[$i]->tpsVf as $tpVf)
              
            @if ($tpVf->score != null)
                @if ($tpVf->score->nota >= 7)
                @php
                    $aprobados++;
                @endphp
                @endif
            @endif
          @endforeach
        @endif

        @for($t = 0; $t<count($tps); $t++)
          @if($tps[$t]['id'] == $unidades[$i]['id'])

            @if($aprobados == (count($tps[$t]['tps']) + count($unidades[$i]->tpsVf)))
              @if(count($tps[$t]['tps']) == 0)
                <span class="text-danger"><strong>{{$aprobados}} / {{count($tps[$t]['tps']) + count($unidades[$i]->tpsVf)}}</strong><img height="25" src="/img/warn.png" /></span></p>
                <p>● Evaluaciones: <a href="#" class="text-danger"><strong><i>No disponible</i></strong></a></p>
                <div class="alert alert-danger text-center">Unidad <strong><i>no disponible</i></strong></div>
              @else

                <span class="text-success"><strong>{{$aprobados}} / {{count($tps[$t]['tps']) + count($unidades[$i]->tpsVf)}}</strong><img height="25" src="/img/checked.png" /></span></p>
                <p>● Evaluaciones: <a href="#" class="text-success"><strong><i>Disponible</i></strong></a></p>
              @endif
            @endif

            @if($aprobados != (count($tps[$t]['tps'])  + count($unidades[$i]->tpsVf)))

            <span class="text-danger"><strong>{{$aprobados}} / {{count($tps[$t]['tps']) + count($unidades[$i]->tpsVf)}}</strong><img height="22" src="/img/warn.png" /></span></p>
            <p>● Evaluaciones: <span class="text-danger"><strong><i>Finalizar TP's</i></strong></span></p>
            @endif

          @endif
        @endfor




      <!--  <div class="alert alert-success">Unidad<strong> Completada</strong></div>-->
          <div class="text-center">
          @if ($i < $unidades_habilitadas)              
            <a class="btn btn-conf text-white " href="{{ route('Unidad.index', ['id' => $unidades[$i]['id']])}}">Ver Unidad</a>
          @else
            <button type="button" class="btn btn-danger" data-toggle="popover" title="Aviso!" data-content="Contenido aun no disponible">Ver Unidad</button>
          @endif
          </div>
        </div>
      </div>
    </div>

    @endfor

    @elseif (Auth::user()->tipo_pago == "test")
    
    @foreach($unidades as $index => $unity)

    <div class="col-md-4 mb-4">
      <div class="card">
        <div class="card-header bg-conf text-white text-center">
          <strong style="font-family: Arial !important;">Unidad {{$index+1}} - {{$unity->nombre}}</strong>
        </div>
        <div class="card-body text-secondary ">
          <p>● Trabajos Prácticos:
            @php
              $aprobados = 0;
            @endphp
  
            @for($x=0; $x<count($entregados); $x++)
              @if($unity->id == $entregados[$x]['unity_id'])
                @for($z=0; $z<count($entregados[$x]['scores']); $z++)
                  @if($entregados[$x]['scores'][$z]['user_id'] == Auth::user()->id && $entregados[$x]['scores'][$z]['nota'] == 'aprobado')
                    @php
                        $aprobados++;
                    @endphp
                  @endif
                @endfor
              @endif
            @endfor
            
            @if (count($unity->tpsVf) != 0)
              @foreach ($unity->tpsVf as $tpVf)
                  
                @if ($tpVf->score != null)
                    @if ($tpVf->score->nota >= 7)
                    @php
                        $aprobados++;
                    @endphp
                    @endif
                @endif
              @endforeach
            @endif
  
            @for($t = 0; $t<count($tps); $t++)
            @if($tps[$t]['id'] == $unity['id'])
  
              @if($aprobados == (count($tps[$t]['tps']) + count($unity->tpsVf)))
                @if(count($tps[$t]['tps']) == 0)
                  <span class="text-danger"><strong>{{$aprobados}} / {{count($tps[$t]['tps']) + count($unity->tpsVf)}}</strong><img height="25" src="/img/warn.png" /></span></p>
                  <p>● Evaluaciones: <a href="#" class="text-danger"><strong><i>No disponible</i></strong></a></p>
                  <div class="alert alert-danger text-center">Unidad <strong><i>no disponible</i></strong></div>
                @else
  
                  <span class="text-success"><strong>{{$aprobados}} / {{count($tps[$t]['tps']) + count($unity->tpsVf)}}</strong><img height="25" src="/img/checked.png" /></span></p>
                  <p>● Evaluaciones: <a href="#" class="text-success"><strong><i>Disponible</i></strong></a></p>
                @endif
              @endif
  
              @if($aprobados != (count($tps[$t]['tps'])  + count($unity->tpsVf)))
  
              <span class="text-danger"><strong>{{$aprobados}} / {{count($tps[$t]['tps']) + count($unity->tpsVf)}}</strong><img height="22" src="/img/warn.png" /></span></p>
              <p>● Evaluaciones: <span class="text-danger"><strong><i>Finalizar TP's</i></strong></span></p>
              @endif
  
            @endif
          @endfor
  
  
  
  
        <!--  <div class="alert alert-success">Unidad<strong> Completada</strong></div>-->
            <div class="text-center">
              @if ($index < $curso->courseTest->unities)
                  
              <a class="btn btn-conf text-white " href="{{ route('Unidad.index', ['id' => $unity->id])}}">Ver Unidadmaxiracciatti_95@hotmail.com

              </a>
              @else
              <button type="button" class="btn btn-danger" data-toggle="popover" title="Aviso!" data-content="Contenido no disponible en la version de prueba">Ver Unidad</button>
              @endif
            </div>
          </div>
        </div>
      </div>

    @endforeach
    @endif
@endif

@if (count($curso->problems) != 0)
  <div class="col mb-4">
    <div class="card">
      <div class="card-header bg-primary text-white text-center">
        <strong style="font-family: Arial !important;">Fallas comunes</strong>
      </div>
      <div class="card-body text-secondary ">
        <p>En esta seccion podras encontrar reparaciones paso a paso para fallas comunes. 
        </p>
        <hr>
        <div class="d-flex justify-content-center">

          <a class="btn btn-primary" href="{{route('Problem.showProblems',['Course' => $curso])}}">Ingresar <span class="badge badge-danger">New</span></a>
        </div>
      </div>
    </div>
  </div>
@endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif
@endif
@endif

@if($bandera == 0)
  <div class="alert alert-danger text-center">Usted no se encuentra inscripto a éste curso. </div>
@endif

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
  @media (min-width: 1281px) {

    #img{
      height: 80px;
    }

  }
  @media (min-width: 320px) and (max-width: 480px) {

    #img{
      height: 50px;
    }

  }
</style>
<script>
  var control = 0;
  window.onload=function(){

    $(function () {
      $('[data-toggle="popover"]').popover();
      $('#tip').popover('toggle');
      
      $('#tip').on('show.bs.popover', function () {
        if (control == 0) {
          control = 1;
          setInterval(function(){ $('#tip').popover('hide'); }, 4000);
        }
        
      });
    });
  }

function mostrarTip() {
  $('#tip').popover('show');
}

</script>
@endsection
