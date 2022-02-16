@extends('layouts.app')

{{--MENSAJE DE MAIL ENVIADO, EL MSG SE RECIBE DESDE VENDEDORCONTROLLER--}}
@if(session('msg'))
    <div class="alert alert-{{session('msg')}}">
        @if (session('msg') == 'success')
            <p>E-mail Enviado con exito</p>
        @elseif (session('msg') == 'danger')
            <p>Error con el servidor, no se pudo enviar.</p>
        @endif
    </div>
@endif

@section('content')

<div class="container">
    
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-4 ">

                    <img class="mr-3 h-40" src={{ asset('img/cohete.jpg') }} class="mr-3" alt="avatar">
                            
    
                </div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mt-0">{{$user->name}}</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong> Cantidad de ventas : </strong>
                                    <h3 class="text-center text-2xl">{{ count($ventas) }}</h3> 
                                </li>
                                <li class="list-group-item">
                                    <strong> Comision actual: </strong>
                                    <h3 class="text-center text-2xl">$ {{ $comision}}</h3> 
                                        
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="media mb-3">
                
                <div class="media-body">
                    
                
                </div>
            </div>
            {{--
                <div class="mb-3">
                    <div class="border border-dark p-4">
                        
                        <h5 class="text-danger font-weight-bold">Queremos saber tu opinion</h5>
                        <p>Por favor tomate unos minutos para responder unas preguntas sobre ambiente laboral.</p>
                        <hr>
                        <a class="btn btn-outline-dark btn-block" target="_blank" href="https://docs.google.com/forms/d/1B7fSuipm45iPDQfNGCkh1g8z4LyhcQbkmHbW2CBlqJ4/edit">Ir a la encuesta</a>
                    </div>
                </div>
                --}}
            <div class="grid grid-cols-2">

                <div class="col-span-1">

                
                    <div class="card mb-3">
                        <div class="card-header bg-secondary text-white">
                            Funciones
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href={{route ('crearAlumno')}}><button type="button" class="btn btn-danger">INSCRIBIR</button></a>
                            </li>
                            <li class="list-group-item">
                                <a href="Vendedor/envio-mail/informativo"><button type="button" class="btn btn-danger">ENVIAR MAIL INFORMATIVO</button></a>
                            </li>
                            <li class="list-group-item">
                                <a href="Vendedor/envio-mail/cupon"><button type="button" class="btn btn-danger">ENVIAR MAIL CUPON</button></a>
                            </li>
                            <li class="list-group-item">
                                <a href={{route ('Vendedor.verMailsEnviados',['id'=> $user->id])}}><button type="button" class="btn btn-danger">VER LISTA DE MAILS ENVIADOS</button></a>
                            </li>
                            <li class="list-group-item">
                                <a href={{route ('Vendedor.verPrecios')}}><button type="button" class=" bg-red-700 p-2 rounded text-white">VER LISTA PRECIOS</button></a>
                            </li>

                        </ul>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header">
                            Ventas
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href={{route ('vendedor.historial')}}><button type="button" class="btn btn-success">Historial de ventas</button> <span class="bg-red-600 p-1 font-bold text-white rounded">new</span></a>
                            </li>
                        </ul>
                    </div>
                </div>

                @if (Auth::user()->rol == 'supervisor')
                    
                <div class="col-span-1 p-2">
                    <div class="bg-blue-900 text-white p-2">
                        
                        Supervisor
                    </div>
                    <div class="p-2 border-2">
                        <div class="mb-2 font-bold">
                            <i class="fas fa-search text-blue-600"></i>
                            <a href="{{ route('Admin.Buscador') }}">Buscador...</a>
                        </div>
                        <div>
                            <i class="fas fa-list text-purple-900"></i>
                            <a href="{{ route('VerNoHabilitados') }}">Ver no habilitados</a>
                        </div>
                    </div>
                </div>

                @endif

                {{--
                <div class="col-span-1 ml-2">
                    <div class="grid grid-flow-row">

                        @foreach ($customs as $custom)
                            <div class="row-span-1">
                                <div class="border-2 border-pink-300 bg-pink-100 rounded p-2 shadow-xl">
                                    <h1 class="text-xl text-pink-400 font-bold">{{$custom->name}}</h1>
                                    <hr class="border-2 border-pink-300 my-2">
                                    <div class="flex justify-between">
                                        <p class="text-lg">Objetivo : <br><strong>{{$custom->progreso.' / '.$custom->objetivo}}</strong> </p>
                                        <p class="text-lg">Premio : <strong>${{$custom->premio}}</strong></p>
                                    </div>
                                    <div class="w-full relative bg-pink-300 h-8">
                                        <div class="absolute h-8 bg-pink-800" style="width: {{(($custom->progreso/$custom->objetivo)*100) < 100 ?(($custom->progreso/$custom->objetivo)*100):100 }}%">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                --}}
            </div>
        </div>
        <div class="col">

            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <strong>  Datos Utiles</strong>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" >
                        <strong style="color:#04B431">Numero profesor wpp :  </strong><strong> 11 2694-2226 </strong> <i style="color:#04B431" class="fab fa-whatsapp-square fa-2x"></i>
                        
                        <hr class="mb-3 mt-3">
                        <strong style="color:#ff7b00">Numero tienda :  </strong><strong> 223 677-2444 </strong> <i style="color:#d16c0d" class="fas fa-shopping-cart fa-2x"></i>
                        <br>
                        <strong style="color:#ff5100">Web tienda :  </strong><strong> <a href="https://worknowshop.mitiendanube.com/">https://worknowshop.mitiendanube.com/</a> </strong> <i style="color:#af4d0b" class="fas fa-splotch fa-2x"></i>
                        <hr class="mb-3 mt-3">
                        <button class="btn btn-primary font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNumeros" aria-expanded="false" aria-controls="collapseNumeros">
                            Numeros asesoras <i style="color:#380c72" class="fas fa-phone fa-1x"></i>
                        </button>
                        <div class="collapse mt-2" id="collapseNumeros">
                            <ul>
                                <li><b>Duos :</b> 2236774462</li>
                                <li><b>Pixie :</b> 2236774463</li>
                                <li><b>Lg :</b> 1124612444</li>
                            </ul>
                        </div>
                        
                    </li>
                    <li class="list-group-item flex justify-between">
                        <strong style="color:#B40404">Correo consultas :  </strong><strong> worknowcursos@gmail.com</strong>
                        <img src={{ asset('img/gmail.png') }} class="h-10">
                    </li>
                    <li class="list-group-item flex justify-between">
                        <strong style="color:#8904B1">Pagina oficial :  </strong><strong> www.worknowcursos.com</strong>
                        <img src={{ asset('img/web.png') }}  class="h-10">
                    </li>
                    <button class="btn btn-primary font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseKit" aria-expanded="false" aria-controls="collapseKit">
                         Seguimientos de envios <i style="color:#380c72" class="fas fa-truck fa-1x"></i>
                    </button>
                    <div class="collapse" id="collapseKit">
                        <li class="list-group-item">
                            <strong style="color:#4f04b1">Seguimiento envio del kit (OCA) :  </strong><strong><a href="https://www.oca.com.ar/envios/paquetes/">https://www.oca.com.ar/envios/paquetes/</a></strong>
                        </li>
                        <li class="list-group-item">
                            <strong style="color:#4f04b1">Seguimiento envio del kit (SendBox) :  </strong><strong><a href="http://www.sendbox.ar/skin1/consultas.asp">http://www.sendbox.ar/skin1/consultas.asp</a></strong>
                        </li>
                        <li class="list-group-item">
                            <strong style="color:#4f04b1">Seguimiento envio del kit (Andreani) :  </strong><strong><a href="https://usuarios.e-andreani.com/#!/main" target="_blank" >https://usuarios.e-andreani.com/#!/main</a></strong>
                        </li>
                    </div>
                    <li class="list-group-item">
                        <strong style="color:#045FB4"><a href="/sss">Validador tarjetas </a> </strong>
                        <hr>
                        <div class="border border-primary rounded p-3">
                            
                            <h5 class="text-primary mb-3">Tarjetas debito (abona por cupon): </h5>
                            <ul class="text-blue-900 font-bold">
                                <li class="flex justify-between">4517 <img class="h-10" src="https://i0.pngocean.com/files/371/4/54/visa-debit-card-credit-card-logo-mastercard-visa.jpg" alt=""></li>
                                <li class="flex justify-between">6042 (puede ser credito, preguntar) <img class="h-10" src="https://tuquejasuma.com/media/images/thumbnails/321313_tarjeta_nueva_tarjeta_cabal.jpg" alt=""></li>
                                <li class="flex justify-between">5010 <img class="h-10" src="https://i0.wp.com/www.ebizlatam.com/wp-content/uploads/2017/03/Maestro-Tarjeta.jpg?fit=510%2C374" alt=""></li>
                            </ul>
                            <hr class="mb-3">
                            <h5 class="text-primary mb-3">Tarjetas prepagas (si es un pago, se toma si no, es cupon): </h5>
                            <ul class="text-blue-900 font-bold">
                                <li class="flex justify-between">5547 <img class="h-10" src="https://pbs.twimg.com/profile_images/1277624431255355392/gUjuxmmd.jpg" alt=""></li>
                                <li class="flex justify-between">5258 <img class="h-10" src="https://seeklogo.com/images/U/uala-logo-7959775EA9-seeklogo.com.png" alt=""></li>
                                <li class="flex justify-between">4513 <img class="h-10" src="https://www.buenosaires.travel/wp-content/buenosaires_uploads/Banco-provincia-324x190.jpg" alt=""></li>

                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            {{--
                @include('layouts.comisiones')
                --}}
        </div>
    </div>
</div>

@endsection