@extends('layouts.app')

@section('content')
<div class="fixed z-10">
  <div class="absolute top-2 left-0 border-2 border-orange-400 bg-white rounded-full">
      <a class="text-orange-400"  href="{{route('Curso.show',['id'=>$course->id])}}"><i class="fas fa-arrow-circle-left fa-3x"></i></a>
  </div>
</div>
    <div class="container tarjeta-unidad">
      <div class="card ">
        <div class="card-header text-center">
          <h3 class="text-lg"> {{$unity->nombre}}</h3>
        </div>
        <div class="card-body p-5">

          <div class="alert alert-info text-center">
            <div class="flex justify-center ">

              <h4 class="text-lg">Principales temas en la unidad</h4>
              <button class="btn btn-primary ml-3" 
                      type="button" 
                      data-toggle="collapse" 
                      data-target="#collapseDesc" 
                      aria-controls="collapseDesc"
              >Ver mas</button>
            </div>
            <div class="collapse" id="collapseDesc" >
              <p>{{$unity->descripcion}}</p>
            </div>
          </div>{{--END ALERT DESCRIPCION--}}
        

          <div class="text-center">
            <h2 class="text-3xl">Modulos</h2>
            <div class="row justify-content-center">
            @foreach ($unity->modules as $i => $module)
              <div class="col-md-3 mt-3">
                <div class="card">
                  <div class="card-body text-center ">
                    <div class="flex justify-center">

                      <img class="h-24" src="{{asset('img/pdf.png')}}" />
                    </div>
                    @if ($course->pivot->type != 'test')
                        
                    <p style="font-size: 13px;margin-top:5px;" class="text-center"><a class="btn btn-success" href="{{$module->url}}">{{$module->titulo}}</a></p>
                    @else
                      @if ($i < $unity->courses[0]->courseTest->unities)
                          
                        <p style="font-size: 13px;margin-top:5px;" class="text-center"><a class="btn btn-success" href="{{$module->url}}">Modulo N° {{$i+1}}</a></p>
                      @else
                        <p style="font-size: 13px;margin-top:5px;" class="text-center">
                          <button type="button" class="btn btn-danger" data-toggle="popover" title="Atencion!" data-content="No disponible en la version de prueba">Modulo N° {{$i+1}} <br> No disponible</button>
                        </p>

                      @endif

                    @endif
                  </div>
                </div>
              </div>
            @endforeach
            </div>
          </div>{{--END CAJA MODULOS--}}

          <hr class="mb-4 mt-4">
          @if ((count($unity->videos) != 0) || (count($unity->videosYT) != 0))
              
          <div class="text-center mt-3">
            <h1 class="text-3xl mb-3">Videos Explicativos</h1>
            <div class="row">
              @include('course.videos-unity',['unity' => $unity])
              
            </div>
          </div>{{--END CAJA TPS--}}
          @endif

          <hr>

          <div class="text-center mt-3">
            <h1 class="text-3xl">Trabajos Practicos</h1>
            <div class="row">

              @include('course.tps-unity',['unity'=>$unity, 'course'=>$course]) {{--Muestra los tps de la unidad--}}

            </div>
          </div>{{--END CAJA TPS--}}

          

          <div class="text-center mt-3">
            @include('course.exams-unity',['unity' => $unity, 'course'=>$course])

          </div>


        </div>{{--end card-body unity--}}
      </div>{{--end card unity--}}
    </div>{{--end container--}}
    <script>
      $(function () {
        $('[data-toggle="popover"]').popover()
      })
    </script>
@endsection

