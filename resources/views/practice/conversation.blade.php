<h1 class="text-2xl mb-2">Conversacion</h1>
@if ($practice->conversation($user_id) == null)
    @if (Auth::user()->rol == 'alumno')
        
    <div class="alert alert-info">
        <p>Aun no hay mensajes. Inicia la conversacion enviando uno!</p>
    </div>
    @else
    <div class="alert alert-danger">
        <p>El alumno aun no ha realizado ninguna entrega parcial o dejado un mensaje.</p>
    </div>
    @endif
@else
   
    @foreach ($practice->conversation($user_id)->answers as $answer)
        <hr class="mb-2">
        <h4 class="{{$answer->isAdmin() ?'text-success':'text-danger'}} text-2xl mb-2">{{$answer->isAdmin() ?'Profesor':'Alumno'}}</h4>
        <div class="border border-{{$answer->isAdmin() ?'success':'danger'}} rounded p-3 mb-3">


            <p class="text-secondary mb-2">{{$answer->msj}}</p>
            <div class="d-flex justify-content-center">

                <img width="300px" src="{{$answer->img->url ?? ''}}" alt="">
            </div>
      

            <hr class="mb-3">
            <div class="d-flex justify-content-end">
                <small>{{$answer->created_at}}</small>
            </div>
        </div>
    @endforeach
@endif