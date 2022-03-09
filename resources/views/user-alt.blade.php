@extends('layouts.app')

@section('panel')
@php
  use App\Course;
  use App\Unity;
  use App\Exam;
  use Carbon\Carbon;
@endphp
<div class="container">


  <div class="row justify-content-center">

        

        <div class="col-md-8">
       
          <div class="card">
            <div class="card-header bg-conf text-white"><strong>Cursos Disponibles</strong></div>
            <div class="card-body">
   
                <div class="row justify-content-right">

                  @if(!$cursos->isEmpty())

                    @for($i=0; $i<count($cursos);$i++)

                      <div class="col-md-6">
                        <div class="card mb-3">
                          <div class="card-header text-center bg-dark text-light">{{$cursos[$i]['nombre']}} </div>
                          <div class="card-body text-center">
                            <img width="215" src="{{ asset('img/Escritorio.png') }}" />
                            <a class="btn btn-conf mt-3" href="{{ route('Curso.show', ['id' => $cursos[$i]['id']]) }}">Ingresar</a>
                          </div>

                        </div>
                      </div>
                        
                    @endfor
                        
                  @else
                    <div class="col-md-12">
                      <div class="alert alert-danger text-center">
                          Usted <strong>NO</strong> se encuentra inscripto a <strong>ningun</strong> curso,<br>
                          no se encuentra <strong>habilitado </strong>, o a <strong>incumplido</strong> el pago de una cuota
                      </div>
                      <div class="alert alert-primary text-center">Si desea inscribirse, puede hacerlo abonando el siguiente cupon<br>
                        <a mp-mode="dftl" href="https://www.mercadopago.com/mla/checkout/start?pref_id=373262571-4eb5bf37-bf4e-4857-aaeb-3f73229f4fdd" name="MP-payButton" class='blue-ar-l-rn-aron'>Pagar</a>
                      </div>
                      <script type="text/javascript">
                        (function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
                      </script>
                  
                  
                  
                    </div>

            
                  @endif
                </div>
                </div>
            </div>
          </div>

            <div class="col-md-4">
              <div class="card mb-3">
                <div class="card-header bg-conf text-white"><strong>Datos Personales</strong></div>
    
                <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif
    
                  @if($user != null)
    
                    <div id="datos-noedit">
                      <p><strong>Nombre: </strong>{{ Auth::user()->name }}</p>
                      <p><strong>E-mail: </strong> {{ Auth::user()->email }} </p>
                      <p><strong>Dirección:</strong> {{ $user->direccion }} </p>
                      <p><strong>Teléfono: </strong> {{$user->telefono }} </p>
                      <p><strong>DNI: </strong> {{$user->dni}} </p>
                      <p><strong>Ciudad: </strong> {{$user->ciudad}} </p>
                      <p><strong>Provincia: </strong> {{$user->provincia}} </p>
                      <button onclick="edit()" id="btn-edit" class="btn btn-outline-danger">Editar datos</button>
                    </div>
    
    
    
    
                    <div id="datos-edit" style="display:none;">
                      <form action="{{ route('User.update', ['user_id'=> Auth::user()->id]) }}" method="POST">
                        @csrf
                        <p><strong>Nombre: </strong>{{ Auth::user()->name }}</p>
                        <p><strong>E-mail: </strong> {{ Auth::user()->email }} </p>
                        <div class="form-inline">
                        <p><strong>Dirección: </strong><input type="text" class="form-control" name="address" placeholder="{{ $user->direccion }}"> </p>
                        </div>
                        <div class="form-inline">
                        <p><strong>Teléfono: </strong><input type="text" class="form-control" name="phone" placeholder="{{$user->telefono }}"> </p>
                        </div>
                        <div class="form-inline">
                        <p><strong>DNI: </strong><input type="text" class="form-control" name="dni" placeholder="{{$user->dni }}"> </p>
                        </div>
                        <div class="form-inline">
                        <p><strong>Ciudad: </strong><input type="text" class="form-control" name="city" placeholder="{{$user->ciudad }}"> </p>
                        </div>
                        <div class="form-inline">
                        <p><strong>Provincia: </strong><input type="text" class="form-control" name="province" placeholder="{{$user->provincia }}"> </p>
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
              <div id="faq-box">Loading...</div>
            </div>{{--CIERRE COL-4--}}

          </div>{{--CIERRE CARD CURSOS--}}
        </div>{{--CIERRE COL-8--}}



<div id="inferior" class="container">
  @php
    $delay = 500;
  @endphp
  <div class="row justify-content-center" style="margin-right: 70px; margin-bottom: 40px;" >
    <button type="button" class="btn btn-lg btn-success bg-dark" data-placement="top" data-delay="500" data-bs-toggle="popover" title="Aviso" data-content="Recuerda que puedes hablar con los profesores haciendo click aqui!"></button>
    <a href="https://api.whatsapp.com/send?phone=5491126942226&text=Tengo%20una%20duda%20sobre%20el%20aula%20virtual%20y%20los%20cursos!%20"><img id="img" src="/img/whatsapp.png" ></a>
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
