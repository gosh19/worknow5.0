@foreach ($unity->tps as $i => $tp)
<div class="col-md-6 p-3  tarjeta-unidad">
    <div class="card">
        <div class="card-header">
        Trabajo Practico N° {{$tp->numero}}
        </div>
        <div class="card-body">
            <div class="flex justify-center">

                <img height="100" src="{{asset('img/tp.png')}}" />
            </div>
        @if ($course->pivot->type == 'test')

            @if ($i < 1)
            <p style="font-size: 13px;margin-top:8px;" 
                class="text-center"
                >
                <a class="btn btn-success" href="{{$tp->url}}">TP N°{{$tp->numero}}</a>
            </p>                          
            @else
            <p style="font-size: 13px;margin-top:8px;" class="text-center">
                <button type="button" 
                        class="btn btn-danger" 
                        data-toggle="popover" 
                        title="Atencion!" 
                        data-content="No disponible en la version de prueba"
                >TP N°{{$tp->numero}} <br> No disponible</button>
            </p>
            @endif
                    
        @else {{--No TEST--}}
            <p style="font-size: 13px;margin-top:8px;" 
                class="text-center"
            >
            <a class="btn btn-success mb-3" href="{{$tp->url}}">TP N°{{$tp->numero}}</a>
            </p>
            @if (($tp->scoreUser(Auth::user()->id) == null) || (@$tp->scoreUser(Auth::user()->id)->nota == 'desaprobado'))
                @if (@$tp->scoreUser(Auth::user()->id)->nota == 'desaprobado')
                    <div class="alert alert-danger">
                        <strong>Desaprobado con {{$tp->scoreUser(Auth::user()->id)->nota_numerica}}&nbsp;<i class="fas fa-exclamation-triangle"></i></strong>  
                    </div>
                @endif
                <div class="alert alert-info">

                    <p class="text-secondary">
                        Para que el docente evalúe su <strong>trabajo práctico</strong> 
                        debe subir la <strong>resolución</strong> presionando en <b>Seleccionar archivo</b>
                        En caso de hacer el envio por correo se debe colocar en el asunto, 
                        <b>Nombre completo, unidad, y numero de trabajo practico.</b>
                        De lo contrario <b class="text-danger">no sera corregido</b>
                    </p>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Subir</span>
                    </div>

                    <div class="custom-file">
                    
                    <form class="form-control" action="{{ route('Tpresuelto.store', ['id'=> Auth::user()->id, 'tp_id' => $tp->id, 'unity_id' => $unity->id ]) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        
                        <input type="file" name="tp" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
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
                @switch($tp->scoreUser(Auth::user()->id)->nota)
                    @case('corrigiendo')
                        <div class="alert alert-info">
                            <strong>En corrección..</strong>  
                            <img height="20" src="img/correccion.png" />
                        </div>
                        @break
                    @case('aprobado')
                        <div class="alert alert-success flex justify-center">
                            <strong class="mr-3">
                                Aprobado con {{$tp->scoreUser(Auth::user()->id)->nota_numerica}}
                                <i class="fas fa-check-circle"></i>
                            </strong>  
                            
                        </div>

                        @break
                    @default
                        
                @endswitch
            @endif
            
        @endif
        </div>
    </div>
</div>
@endforeach 

@foreach ($unity->tpsVf as $tp)
@php
    $i++;
@endphp
<div class="col-md-6 p-3  tarjeta-unidad">
    <div class="card">
        <div class="card-header">
            Trabajo Practico N° {{$i+1}}
        </div>
        <div class="card-body">
            <div class="flex justify-center">
                <img height="120" src="{{ asset('img/vf.png') }}" />
            </div>
            <p class="text-secondary">Trabajo en modalidad <b> Verdadero/Falso</b></p>
            <hr>
            @if ($tp->score != null)
                        
                @if (($tp->score->nota) >= 7)
                <div class="bg-success rounded text-center text-white p-2">Trabajo aprobado con <strong> {{$tp->score->nota}} </strong></div>  
                
                @elseif(strcmp(strtotime(date_format($tp->score->updated_at ,'Y-m-d')), strtotime(date('Y-m-d'))) !== 0)
                
                <a href="{{route('TpVf.showw',['id'=>$tp->id])}}" class="btn btn-primary w-100">Intentar Nuevamente</a>
                @else

                <div class="bg-danger rounded text-center p-2 text-white">Trabajo desaprobado, podra intentarlo nuevamente mañana</div>  
                @endif

            @else
                <a href="{{route('TpVf.showw',['id'=>$tp->id])}}" class="btn btn-primary w-100">Ingresar</a>
            @endif
        </div>
    </div>
</div>
@endforeach