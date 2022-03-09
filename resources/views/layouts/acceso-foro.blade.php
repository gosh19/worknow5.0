{{--
@php
    $curs = Auth::user()->courses;
    $bandera = false;

    foreach ($curs as $key => $c) {
        if ($c->id == 41) {
            $bandera = true;
        }
    }

    $newPosts = \App\UserPost::newPosts();
    $cantNuevos = \App\Post::where('habilitado',0)->count();
@endphp

@if ($bandera || Auth::user()->rol == 'admin')
    
    <div class="btn-group">
        <a class="text-white" 
            style="margin:2px;"
            href="{{route('Foro.index')}}"
        >
            Foro de discusión <i class="fas fa-align-left"></i>
            @if ($newPosts != 0)
                
                <br>
                <div class="badge badge-primary">
                    {{$newPosts}} post nuevo(s)
                    <i class="fab fa-ioxhost"></i>
                </div>
            @endif
            @if ((auth()->user()->rol == 'admin') && ($cantNuevos != 0))
                <br>
                <div class="badge badge-warning">
                    {{$cantNuevos}} post nuevo(s)
                    <i class="fab fa-snapchat-ghost"></i>
                </div>
            @endif
           
                
               
        </a>
        
        <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
        <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu " aria-labelledby="dropdownMenuReference">
            @foreach (auth()->user()->postNotis() as $item)
                <a class="dropdown-item" href="{{route('Post.show',['Post'=> $item->post])}}">
                    <b class="{{($item->user->rol == 'admin')? 'text-success':'text-primary'}}">
                        {{$item->user->name}}
                    </b><br> 
                     <b>{{$item->case == 'comentario'?'ha dejado un comentario':'ha dado Me gusta'}}</b> <br>
                    en un post que sigues <br>
                    - <small class="text-secondary">{{date_format($item->updated_at, 'd-m H:i')}}Hs</small> </a>
                <div class="dropdown-divider"></div>
            @endforeach
            <a class="dropdown-item" href="{{route('Foro.verNotificaciones')}}">Ver mas...</a>
        </div>
        @if (count(auth()->user()->postNotis()) != 0)
            
            <span class="badge badge-primary h-50">{{count(auth()->user()->postNotis())}}</span>
        @endif
    </div>
    
@endif
--}}