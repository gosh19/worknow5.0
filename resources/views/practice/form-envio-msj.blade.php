<div class="border border-primary rounded p-3 mb-3">
    <div class="alert alert-info">
        <p>Envia un msj en caso de trabarte, o tener alguna duda en el proceso.
            Recuerda que puedes ir subiendo tus avances parciales para que tu profesor
            los vaya viendo y guiandote.</p>
    </div>
    @if (Auth::user()->rol == 'alumno')
        
    <form action="{{route('Conversation.loadMsj',['practice_id'=> $practice->id])}}" enctype="multipart/form-data" method="post">
    @else
    <form action="{{route('Conversation.loadMsjAdmin',['practice_id'=> $practice->id,'user_id'=>$user_id])}}" enctype="multipart/form-data" method="post">  
    @endif
        @csrf
        <div class="mb-3">
            <h2 class="text-primary">Mensaje</h2>
            <textarea class="form-control border border-info rounded" name="msj" rows="4" id="validationTextarea" placeholder="..." required></textarea>
        </div>
        <div class="mb-3">
            <input type="file" name="img" id="">
        </div>
        <hr>
        <div class="">
            <input type="submit" class="btn btn-primary btn-block" value="Enviar">
        </div>
    </form>
</div>