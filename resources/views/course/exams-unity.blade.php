@if ((count($unity->tpsFinals) != 0) || (count($unity->exams) != 0))
<hr class="mb-3">
    <h1 class="text-3xl">Evaluacion</h1>
    @if (($unity->tpsAprobados() < (count($unity->tps)+count($unity->tpsVf))) && Auth::user()->rol !='admin')

        <div class="alert alert-danger w-100">
        <p>Debe aprobar <b> todos </b>los trabajos practicos antes de realizar el examen</p>
        </div>

    @else
        @if (Auth::user()->tipo_pago == 'test')
        <div class="alert alert-danger w-100">
            <p>Examen <b> no disponible</b> en la version de prueba</p>
        </div>
        @else
        
        <div class="grid grid-cols-1 md:grid-cols-2">

            
            @foreach ($unity->tpsFinals as $tpFinal)

                <div class="col-span-1 tarjeta-unidad">
                    <div class="card mt-3">
                        <div class="card-header font-weight-bolder text-white bg-danger ">
                        Trabajo Practico Final 
                        </div>
                        <div class="card-body">
                        <div class="h-32 flex justify-center">

                            <img class="max-h-full" src="{{ asset('img/Tp-final.png') }}">
                        </div>
                        <p class="text-center text-secondary mt-2">
                            Una vez aprobados todos los trabajos prácticos tiene 
                            acceso para poder el trabajo final de la unidad. Debe ser entregado de manera prolija.
                            La nota sera <b>Aprobado</b> o <b>desaprobado</b> unicamente.
                        </p><br>
                        <div class="row justify-content-center mb-3">
                            <a id="confirmation" href={{$tpFinal->url}} class="btn btn-success">Ver</a>
                        </div>
                        <hr class="mb-3">
                        <div class="custom-file">
                            @if (($tpFinal->state() == null) || ($tpFinal->state() == 'desaprobado'))
                                
                            <form class="form-control" action={{ route('cargarTpFinal')}} enctype="multipart/form-data" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value={{Auth::user()->id}}>
                                <input type="hidden" name="tpFinalId" value={{$tpFinal->id}}>
                                <input type="file" name="tpFinal" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                <input id="inputTpFinal" class="custom-file-label text-left" for="inputGroupFile01" placeholder="Seleccionar archivo..." style="width: 100%" />
                                <input  type="submit" class="btn btn-conf mr-5 mb-5" value="Enviar resolución!">
                            </form>
                            @else
                            @if ($tpFinal->state() == 'corrigiendo')
                            <div class="alert alert-info">
                                <b>Corrigiendo...</b>
                                <img height="20" src="img/correccion.png" />
                            </div> 
                            @else
                                
                            <div class="alert alert-success">
                                <b>{{$tpFinal->state()}}</b> 
                                <img height="20" src="{{ asset('img/checked.png') }}" />
                            </div> 
                            @endif

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
            
            @foreach ($unity->exams as $exam)
                <div class="col-span-1 tarjeta-unidad">
                <div class="card mt-3">
                    <div class="card-header font-weight-bolder text-white bg-danger ">
                    <h5> Multiple Choice</h5>
                    </div>
                    <div class="card-body">
                        <div class="h-32 flex justify-center">

                            <img class="max-h-full" src="{{ asset('img/multiple-choice.png') }}" alt="" srcset="">
                        </div>
                    <p class="text-center text-secondary mt-3">
                        Evaluacion en formato de opcion multiple. Tendra <b>una oportunidad</b> 
                        cada 10 dias para la realizacion en caso de fallar.
                    </p>
                    <hr class="mb-3 mt-3">
                    
                    @if ($exam->scoreExams()['state'])


                        <a id="confirmation" 
                            href="{{ route('Exam.index', [
                                                        'user_id' => Auth::user()->id, 
                                                        'unity_id' => $unity->id, 
                                                        'exam_id' => $exam->id 
                                                        ]) }}" 
                            class="btn btn-success"
                        >Estoy preparado para rendir!</a>
                        
                    @else
                        @if (isset($exam->scoreExams()['nota']))
                            <div class="alert alert-success text-center">
                                <strong class="mr-3">
                                    Examen aprobado
                                    <i class="fas fa-check-circle"></i>
                                </strong>  
                            </div>
                        @else
                            
                        <div class="alert alert-danger text-center">
                            <strong class="mr-3">
                                Examen desaprobado
                                <i class="fas fa-exclamation-triangle"></i>
                            </strong> 
                        <hr>
                        <p class="text-center">
                            El recuperatorio es a partir del día: 
                            <strong> {{$exam->scoreExams()['fecha']}} </strong></p>
                        </div>
                        @endif
                    @endif

                    </div>
                </div>
                </div>    
            @endforeach
        </div>

        @endif
    @endif
@endif

