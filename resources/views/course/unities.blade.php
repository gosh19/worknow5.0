<div class="container-fluid">
    

<div class="row">
    @foreach ($course->unities as $key =>  $unity)
    <div class="col-md-4 tarjeta-unidad mb-3">
        <div class="card mb-3 h-full">
            <div class="card-header text-center">
               Unidad {{$key+1}} - {{$unity->nombre}} 

            </div>
            <div class="card-body">
                <ul class="text-secondary">     
                    <li>
                        <strong>Trabajos Practicos: </strong>
                        @php
                            $theme = 'danger';
                            $cantTps = count($unity->tps)+count($unity->tpsVf);
                            if ($unity->tpsAprobados() == $cantTps){
                                $theme = 'success';
                            }
                        @endphp
                            <span class="text-{{$theme}} font-weight-bolder">

                        {{$unity->tpsAprobados()}}/{{$cantTps}} </span>
                    </li>
                    @if ((count($unity->exams)!= 0) || (count($unity->tpsFinals)!= 0))

                    <li>
                        <strong>Evaluaciones: </strong> 
                        <i class="text-{{$theme}} font-weight-bolder">
                            {{($unity->tpsAprobados() == ($cantTps))? 'Disponible':'Finalizar Tp\'s'}}
                        </i>
                    </li>
                    @endif
                    <li>
                        <strong>Promedio: </strong> 
                        <i class="text-primary font-weight-bolder">
                            {{$unity->promedio}}
                        </i>
                    </li>
                </ul>    
                <hr class="mb-3">
                @if ($unity->notification != 0)
                <div class="alert alert-info">
                    <div class="d-flex justify-content-center">

                        <p>Actividad corregida</p>
                        <img height="30px" src="{{ asset('img/notification-bell.png') }}" alt="">
                    </div>
                </div>
                @endif
                <div class="d-flex justify-content-center">
                    @if ((@$course->pivot->type != 'test') )
                        
                    <a class="btn btn-conf text-white " href="{{ route('Unity.showUser', ['unity' => $unity])}}">Ver Unidad</a> 
                    @else 
                    

                        @if (($key+1) <= 1)
                        <a class="btn btn-primary text-white " href="{{ route('Unity.showUser', ['unity' => $unity])}}">Ver Unidad</a> 
                        @else
                        <button type="button" class="btn btn-danger" data-bs-toggle="popover" title="Aviso!" data-content="Contenido no disponible en la version de prueba">No disponible</button>
                        @endif

                        
                    @endif
                </div>


            </div>
        </div>
    </div>
    @endforeach
    @if (count($course->problems) != 0)
    <div class="col-md-4 mb-3">
        <div class="card text-white bg-primary">
            <div class="card-header font-weight-bold text-center">
              <h5>Fallas comunes</h5>
            </div>
            <div class="card-body">
                <p class="card-text">
                    En esta seccion podras encontrar reparaciones explicadas <strong> paso a paso </strong>para fallas comunes. 
                    De todas formas recuerda que puedes consultar en todo momento con tu profesor a cargo via WhatsApp
                </p>
                <hr class="mb-3">
                <div class="d-flex justify-content-center">
                    @if (@$course->pivot->type == "test")
                    <button type="button" class="btn btn-danger" data-bs-toggle="popover" title="Aviso!" data-content="Contenido no disponible en la version de prueba">No disponible</button>
                       
                    @else
                        
                    <a class="btn btn-info  font-weight-bolder" href="{{route('Problem.showProblems',['Course' => $course])}}">Ingresar</a>
                    @endif
                </div>

            </div>
        </div>
    </div>
        
    @endif

    @if (count($course->practices) != 0)
    <div class="col-md-4 mb-3">
        <div class="card  bg-warning ">
            <div class="card-header font-weight-bolder text-center">
              <h5>Practicas</h5>
            </div>
            <div class="card-body">
                <p class="card-text">
                    Ingresa para encontrar practicas referentes a tu curso, podras ver como realizarlas paso a paso.
                    Ademas, podras hacer entregar <b> parciales</b> para que el profesor pueda ir viendo tus avances y te vaya guiando.
                    Recuerda que tienes siempre habilitado el contacto por whatsapp. 
                </p>
                <hr class="mb-3">
                <div class="d-flex justify-content-center">
                    @if (@$course->pivot->type == "test")
                    <button type="button" class="btn btn-danger" data-bs-toggle="popover" title="Aviso!" data-content="Contenido no disponible en la version de prueba">No disponible</button>
                       
                    @else
                        
                    <a class="btn btn-success text-dark  font-weight-bolder" href="{{route('Practice.showPractices',['Course' => $course])}}">Ingresar</a>
                    @endif
                </div>

            </div>
        </div>
    </div>
        
    @endif
    
</div>
</div>