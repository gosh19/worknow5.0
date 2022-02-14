@extends('layouts.app')

@section('content')
    @foreach ($notificaciones as $not)
        <div class="alert alert-{{$not->visto? 'info':'success'}} w-100">
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <b>{{$not->user->name}}</b> 
                        @if ($not->case == 'comentario')
                            
                            ha dejado un <b>comentario</b> <i class="fas fa-pen-square"></i>
                        @else
                            ha dado <b>me gusta</b> <i class="fas fa-heart"></i>
                        @endif
                        
                        en una publicacion que sigues
                        - <small class="text-seconday">{{$not->updated_at}}</small>
                    </p>
                </div>
                <div class="col-md-1">
                    <a href="{{route('Post.show',['Post'=> $not->post])}}">Ir al post<i class="fas fa-arrow-circle-right"></i></a>
                    
                </div>
                <div class="col-md-5">
                    {{$not->post->text}}
                </div>
            </div>
        </div>
    @endforeach
@endsection