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
    <div id="inferior" class="container">
        <div class="row justify-content-center" style="margin-right: 70px; margin-bottom: 40px;" >
          <a href="https://api.whatsapp.com/send?phone=5491126942226&text=Tengo%20una%20duda%20sobre%20el%20aula%20virtual%20y%20los%20cursos!%20"><img id="img" src="/img/whatsapp.png" ></a>
        </div>
    </div>

    <style>
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
        #inferior img{
            max-width: 100px;
        }
    </style>
    <script>
        window.onload=function(){   
          $(function () {
            $('[data-bs-toggle="popover"]').popover();
            $('#tip').popover('toggle');
            
          });
        }    
      </script>
@endsection
