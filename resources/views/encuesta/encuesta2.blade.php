@php
    $res = \App\Encuesta::find(Auth::id());

    $curs = Auth::user()->courses;

    $bandera = false;
/*
    foreach ($curs as $key => $c) {
        if ($c->id == 41) {
            $bandera = true;
        }
    }
*/
@endphp

@if ($bandera && (auth()->user()->tipo_pago != 'test') && (auth()->user()->habilitado))
    

<div id="caja-encuesta" class="card mb-3">
    <div class="card-header cabecera-encuesta text-white font-weight-bolder">
        CLASE EN VIVO
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <div class="alert alert-info text-center">
                    <h4>
                        Ingresa al siguiente link para ver la clase en vivo 
                    </h4>
                    <p>Estaremos viendo cambios de modulos con pistola de calor, tecnicas y consejos!!</p>
                    <h3>Inicia 19hs HOY 30/09</h3>
                    <small>No olviden ingresar al foro para publicar trabajos o ayudar a algun compañero que lo necesite.</small>
                </div>
                <div class="row justify-content-center mb-3">

                    <a class="btn btn-danger" href="https://us02web.zoom.us/j/89868180519">Ingresar</a>
                </div>
                <p>Link para copiar: <b>https://us02web.zoom.us/j/89868180519</b></p>
                <div class="alert alert-danger">
                    <p>Podran ingresar a partir de las 19hs</p>
                    <p>Recuerden instalar la aplicacion de zoom, ya se en la PC o en el celular para ir ahorrando tiempo</p>
                </div>
            </div>
            <div class="col-4">
                <div id="img1">

                    <img src="{{ asset('img/mun.png') }}" width="100%" alt="" srcset="">
                </div>
            </div>
        </div>
        
    </div>
</div>


@endif