@extends('layouts.app')

@section('curso')
<div class="fixed z-10">
    <div class="absolute top-2 left-0 border-2 border-orange-400 bg-white rounded-full">
        <a class="text-orange-400"  href="{{route('User.show',['id'=>Auth::id()])}}"><i class="fas fa-arrow-circle-left fa-3x"></i></a>
    </div>
</div>
    <div class="container relative">
        
        <div class="card">
            <div class="card-header bg-conf text-center">
                {{$curso->nombre}}
            </div>
            <div class="card-body">
                <div class="alert alert-info text-center">
                    <div>{!! $curso->descripcion !!}</div>
                    <div class="">

                        Ingresa al 
                        <strong>
                            <a href="{{ url($curso->url_temario)}}">temario</a>
                        </strong> para saber mas sobre lo que aprenderás en toda tu cursada. 
                        <a class="h-20 flex justify-center" href="{{ url($curso->url_temario)}}">
                            <img class="max-h-full" height="35" src="/img/pdf.png" />
                        </a>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    @include('course.unities',['course' => $curso])
                    
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload=function(){   
          $(function () {
            $('[data-bs-toggle="popover"]').popover();
            $('#tip').popover('toggle');
            
          });
        }    
      </script>
@endsection
