@extends('layouts.app')



@if ((!$anuncio) && (Auth::user()->tipo_pago != 'test'))
    


@section('fixed-div')
<link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,400;0,700;1,600&display=swap" rel="stylesheet">

<div id="div_negro" onclick="oculta()">
  <div class="w-3/4 md:w-1/2 justify-center rounded block mx-auto bg-white pb-3">
    <div class="flex h-10 bg-red-700 ">
      <h1 class="self-center flex-1 text-center text-2xl font-bold text-white">Work Now Cursos</h1>
    </div>
    <div class="px-2">
        <div class="text-center">
          <img class="mx-auto py-3" src="{{asset('img/lupa.jpg')}}" width="180px">
          <h1 class="text-lg md:text-2xl">¡Hola {{Auth::user()->name}}!</h1>
          <h2 class="font-bold text-xl md:text-3xl">Queremos saber tu opinión</h2>
          <h4 class="text-md md:text-xl">
            Compartile a los futuros alumnos tu opinion, 
            que tal te esta yendo con el curso y cual es tu experiencia desde que comenzaste.
          </h4>
        </div>
        <div class="py-2 mx-auto bg-red-900 text-white w-60 text-center font-bold my-3 rounded cursor-pointer">

          <a href="https://www.facebook.com/WorkNowcursos/posts/2418872465018575" 
                >Dejar comentario</a>
        </div>
    </div>
  </div>

</div>


<script>
  function oculta(){
    $('#div_negro').fadeOut(1000); 
  }
  window.onload = function(){
    $('#div_negro').fadeIn(1000) ; 
  }
</script>


@endsection

@endif


    
@if (session('mp'))

@section('anuncio')

<div id="div_negro" class="py-4 z-30 w-full" onclick="ocultaD()">

  <div class="w-3/4 md:w-1/2 justify-center rounded block mx-auto bg-white pb-3">
    <div class="flex h-10 bg-red-700 ">
      <h1 class="self-center flex-1 text-center text-2xl font-bold text-white">Work Now Cursos</h1>
    </div>
    <div class=" px-2 ">
        <div>
          @switch(session('mp'))
              @case('approved')
                  <img class="mx-auto py-3" src="{{asset('img/festejo.jpg')}}" width="180px">
                  <div class="text-center">
        
                    <h1 class="text-lg md:text-2xl">¡Hola {{Auth::user()->name}}!</h1>
                    <h2 class="font-bold text-xl md:text-3xl">Bienvenido a Wor Now Cursos</h2>
                    <h4 class="text-md md:text-xl">
                      Ya tenes acceso completo al curso, recorda consultar las dudas que tengas por whatsapp con tu profesor.
                      Los horarios de atencion son de Lunes a Viernes de 10am a 18pm. 
                    </h4>
                    <p class="text-md md:text-lg">¡Te deseamos un buena cursada!</p>
                  </div>
                  <div class="py-2 mx-auto bg-red-900 text-white w-60 text-center font-bold my-3 rounded cursor-pointer">
                    <p>Aceptar</p>
                  </div>
                  @break
              @case('pending')
                  <img class="mx-auto py-3" src="{{asset('img/lupa.jpg')}}" width="180px">
                  <div class="text-center">
        
                    <h1 class="text-lg md:text-xl">¡Hola {{Auth::user()->name}}!</h1>
                    <h2 class="font-bold text-xl md:text-2xl">Tu pago esta en proceso de aprobacion por mercadopago</h2>
                    <h4 class="text-md md:text-xl">
                      Tendras acceso completo al curso una vez aprobado. Esto puede demorar hasta un maximo de 48 horas. 
                      Mantente en contacto con el area de atencion a traves del whatsapp para mas informacion. 
                    </h4>
                    <p class="text-md md:text-lg">Recuerda que los horarios de atencion son de Lunes a Viernes de 10am a 18pm.</p>
                  </div>
                  <div class="py-2 mx-auto bg-red-900 text-white w-60 text-center font-bold my-3 rounded cursor-pointer">
                    <p>Aceptar</p>
                  </div>
                  @break
              @default
                  
          @endswitch
          
        </div>
    </div>
  </div>

</div>


<script>
  function ocultaD(){
    $('#div_negro').fadeOut(1000); 
  }
  window.onload = function(){
    $('#div_negro').fadeIn(1000) ; 
  }
</script>

@endsection


@endif

@section('panel')

<div class="container">
  
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v6.0"></script>

    
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if (Auth::user()->habilitado)

          @include('encuesta.encuesta2')

            @if ($notificationCobro != null)              
            <div class="alert alert-info">
              <h3>Atencion</h3>
              <p>La cuota correspondiente al curso esta proxima a vencer.</p>
              <p>Plazo maximo de pago <strong>{{date_format($notificationCobro, "d-m-Y")}}</strong> </p>
              <h4>Pasada esa fecha se restringira el acceso a la plataforma.</h4>
              <p>En caso de ya haber abonado por favor contactarse con su profesor a cargo o presione a continuacion para enviar el aviso.</p>
              <div class="d-flex justify-content-center">
                @if (Auth::user()->infoPago != null)
                    @if (!Auth::user()->infoPago->visto)
                        <div class="border border-primary p-3 rounded font-weight-bolder text-primary">
                          En revision por el area de cobranzas
                        </div>
                    @else
                      <div class="border border-danger p-3 rounded roundedfont-weight-bolder text-danger">
                        <a href="{{route('User.informarPago')}}" onclick="javascript: return confirm('En caso de haber realizado el pago de la cuota correspondiente, presione en ACEPTAR y se enviara un aviso para que lo revisen en el area de cobranzas')" class="btn btn-danger"> Informar pago</a>
                      </div>
                    @endif
                @else
                    
                  <a href="{{route('User.informarPago')}}" onclick="javascript: return confirm('En caso de haber realizado el pago de la cuota correspondiente, presione en ACEPTAR y se enviara un aviso para que lo revisen en el area de cobranzas')" class="btn btn-primary"> Informar pago</a>
                @endif
              </div>
            </div>
            @endif
            @if ((count(Auth::user()->coursesTest()) <3)&&(count(Auth::user()->coursesTest()) != 0 ))
                
              <div class="container mb-3">
                <div class="bg-blue-400 p-3 rounded ">
                  <p class="font-bold text-white text-center">
                    Aun te quedan por seleccionar {{3- count(Auth::user()->coursesTest())}} curso(s) 
                    para acceder a la promocion de 3 cursos con un 30 % de descuento. 
                    <br> <a href="{{route('User.selectCourses')}}"> ¡Presiona Aqui para elegirlo de la lista!</a>
                  </p>
                </div>
              </div>
            @endif
            <div class="mb-3 block md:hidden">
              @include('user.carrito',['country'=>$country])
            </div>
            <div id="courses-box" class="loading">Loading... En caso de demorar mucho la carga presione<a href="/User/1/1"> aqui </a> </div>
              
          @else
          
          <div class="col-md-12">
            <div class="alert alert-danger text-center">Usted <strong>NO</strong> se encuentra inscripto a <strong>ningun</strong> curso,<br>
                                                        no se encuentra <strong>habilitado </strong>, o a <strong>incumplido</strong> el pago de una cuota</div>
            <div class="alert alert-primary text-center">Si desea inscribirse, puede hacerlo abonando el siguiente cupon<br>
              <a mp-mode="dftl" href="https://www.mercadopago.com/mla/checkout/start?pref_id=373262571-e47e7584-864b-4118-a75a-d55f97cd9899" name="MP-payButton" class='blue-ar-l-rn-aron'>Pagar</a>
            </div>
          <script type="text/javascript">
          (function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
          </script>
        
        
        
          </div>
          @endif
      
          

        </div>
        <div class="col-md-4">
          
          <div class="card mb-3">
            <div class="card-header bg-conf text-white d-flex justify-content-between">
              <strong class="text-center">Datos Personales</strong>
              <button class="btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDatosUser" aria-expanded="false" aria-controls="collapseExample">
                 ↓
              </button>
            </div>
            <div class="collapse" id="collapseDatosUser">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($datosUser != null)
                    <div id="datos-noedit">
                      <p><strong>Nombre: </strong>{{ Auth::user()->name }}</p>
                      <p><strong>E-mail: </strong> {{ Auth::user()->email }} </p>
                      <p><strong>Dirección:</strong> {{ $datosUser->direccion }} </p>
                      <p><strong>Teléfono: </strong> {{$datosUser->telefono }} </p>
                      <p><strong>DNI: </strong> {{$datosUser->dni}} </p>
                      <p><strong>Ciudad: </strong> {{$datosUser->ciudad}} </p>
                      <p><strong>Provincia: </strong> {{$datosUser->provincia}} </p>
                      <button onclick="edit()" id="btn-edit" class="btn btn-outline-danger">Editar datos</button>
                    </div>




                  <div id="datos-edit" style="display:none;">
                    <form action="{{ route('User.update', ['user_id'=> Auth::user()->id]) }}" method="POST">
                       @csrf
                       <p><strong>Nombre: </strong>{{ Auth::user()->name }}</p>
                       <p><strong>E-mail: </strong> {{ Auth::user()->email }} </p>
                      <div class="form-inline">
                      <p><strong>Dirección: </strong><input type="text" class="form-control" name="direccion" placeholder="{{ $datosUser->direccion }}"> </p>
                      </div>
                      <div class="form-inline">
                      <p><strong>Teléfono: </strong><input type="text" class="form-control" name="phone" placeholder="{{$datosUser->telefono }}"> </p>
                      </div>
                      <div class="form-inline">
                      <p><strong>DNI: </strong><input type="text" class="form-control" name="dni" placeholder="{{$datosUser->dni }}"> </p>
                      </div>
                      <div class="form-inline">
                      <p><strong>Ciudad: </strong><input type="text" class="form-control" name="city" placeholder="{{$datosUser->ciudad }}"> </p>
                      </div>
                      <div class="form-inline">
                      <p><strong>Provincia: </strong><input type="text" class="form-control" name="province" placeholder="{{$datosUser->provincia }}"> </p>
                      </div>
                      <div class="form-inline">
                        <input type="submit" class="btn btn-outline-primary" value="Guardar cambios" />
                        <button onclick="noedit()" type="button" class="btn btn-danger ml-2">Cancelar</button>
                      </div>
                    </form>
                  </div>
                @else
                <div>
                  <p><strong>Nombre: </strong>{{ Auth::user()->name }}</p>
                  <p><strong>E-mail: </strong> {{ Auth::user()->email }} </p>
                </div>
                @endif
                </div>

            </div>
          </div>
          <div class="mb-3 w-full shadow-2xl">
            <div class="h-24 grid grid-cols-3 bg-white">
              <div class="col-span-1 bg-red-600 relative h-24" 
                  style="background-image: url('{{$randomCourse->url_img}}');
                          background-position: center;
                          background-repeat: no-repeat;
                          background-size: cover;
                          position: relative;
                          "
              >
                @if ($randomCourse->info != null)
                  @if ($randomCourse->info->on && ($randomCourse->info->discount != null)&&(!$randomCourse->info->free))                               
                    <div class="absolute right-1 top-1">
                      <p class=" bg-red-800 py-1 px-2 text-white text-xs font-extrabold">
                        {{$randomCourse->info->discount}}% Off
                      </p>
                    </div>
                  @else 
                    @if ($randomCourse->info->free)
                      <div class="absolute right-3 top-3">
                        <p class="bg-red-800 py-1 px-2 text-white font-extrabold">
                          GRATIS
                        </p>
                      </div>
                    @endif
                  @endif
                @endif
              </div>
              <div class="col-span-2">
                <div class="p-1">
                  <p class="font-bold tracking-wider text-red-800">{{$randomCourse->nombre}}</p>
                  <hr class="my-2">
                  <div class="h-full">
                    <div class="flex justify-between">

                      <p class="text-gray-600">Agregalo por 
                        <strong>
                          $
                          
                          @if ($randomCourse->info != null)
                          {{number_format($randomCourse->info->getPrecio($country),2,',','.')}}
                          @else
                          {{(($country == 'AR')||($country == 'ARG'))? 1989:($country == 'PY' ?number_format((23*(session('conversion')?? 7045)),2,',','.'):23)}}
                          @endif
                          {{(($country == 'AR')||($country == 'ARG'))? 'ARS':($country =='PY'?'PYG':'USD')}}
                        </strong>
                      </p>
                      <a href="{{route('Curso.agregarAlumno',['user_id'=>Auth::id(),'course_id'=> $randomCourse->id])}}">
                        <i class="far fa-plus-square text-red-700 text-xl mr-3"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr class="w-full border-4 border-red-700">
            <a class="py-2 block bg-red-500 hover:bg-red-400 transition-all duration-300 text-white text-center font-bold tracking-wider text-decoration-none" 
                href="{{route('User.selectCourses')}}"
            >Agregar mas cursos <i class="fas fa-user-graduate"></i></a>
          </div>
          <div class="mb-3 hidden {{--md:block--}}">
            @include('user.carrito',['country'=>$country])
          </div>
          <div class="card mb-3">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
              <div class="d-flex align-content-center">

                <strong class="text-center">Novedades</strong>
                @if ($novedad->cantNoti != 0)
                  <div 
                    style="height: 30px;width: 30px;border-radius:20px;font-weight:bold;" 
                    class="bg-danger text-center text-white p-1 ml-3"
                  >
                    {{$novedad->cantNoti ?? 0}}
                  </div>
                @endif
              </div>
              <span ></span>
              <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNovedades" aria-expanded="false" aria-controls="collapseExample">
                 ↓
              </button>
            </div>
            <div class="collapsee" id="collapseNovedades">
              <div class="card-body">
                @if ($novedad->noti != null)
                <h3 class="text-info text-2xl mb-2">{{$novedad->noti->titulo}}</h3>
                <h5 class="text-1xl mb-2" >{{$novedad->noti->subtitulo}}</h5>
                @else
                <div class="alert alert-info">
                  <h3>Aun no hay novedades cargadas</h3>
                </div>
                @endif
                <a class="btn btn-block btn-primary" href="{{route('Novedad.index')}}">Ir a novedades</a>
              </div>
            </div>
          </div>
            <div id="faq-box">Loading...</div>
            <div class="fb-post" data-href="https://www.facebook.com/WorkNowcursos/posts/2418872465018575" data-show-text="true" data-width=""><blockquote cite="https://www.facebook.com/WorkNowcursos/posts/2418872465018575" class="fb-xfbml-parse-ignore"><p>Nos encanta escuchar las sugerencias y opiniones de nuestros alumnos.

              ¡Queremos saber cual es tu opinión! 
              
              Compartile...</p>Publicada por <a href="https://www.facebook.com/WorkNowcursos/">Work Now</a> en&nbsp;<a href="https://www.facebook.com/WorkNowcursos/posts/2418872465018575">Viernes, 10 de abril de 2020</a></blockquote></div>
</div>
</div>
@php

  $wpp = '5491126942226';
  if (Auth::user()->tipo_pago == 'test') {
    $wpp = '5492236772444';
  }
@endphp
<div id="caja-wpp-tel" class="alert alert-info p-2 pr-4 pl-4">
  <div class="row">
    <div class="col">
      <div class="row align-items-center justify-content-center h-100">

        <a href="tel:08103450527">
          <i class="fas fa-phone-square-alt fa-4x text-primary" ></i>
        </a>
      </div>
    </div>
    {{--                        ESTA ES LA WEA Q MODIFIQUEa
    <div class="col-6">
      <div class="row align-items-center justify-content-center h-100 ml-2">
          <a href="https://api.whatsapp.com/send?phone={{$wpp}}&text=Tengo%20una%20duda%20sobre%20el%20aula%20virtual%20y%20los%20cursos!%20">
            <i class="fab fa-whatsapp-square fa-4x text-success"></i>
        </a>
      </div>
    </div>
    --}}
  </div>
</div>

<script type="text/javascript">
$(function () {
  $('[data-bs-toggle="popover"]').popover('toggle');
});

</script>

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


@endsection
