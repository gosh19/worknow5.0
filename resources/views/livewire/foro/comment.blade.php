
<div>
    <div class="card-body {{($comment->user->rol == 'admin')? 'bg-white-green':''}} ">
        <h4 class="text-2xl mb-3">{{$comment->user->name ?? 'Error'}} - <small>{{$comment->updated_at}}</small> </h4>
        <hr class="mb-3">
        <p class="mb-3">
            {{$comment->text ?? 'Error'}}
        </p>
        <hr class="mb-3">
        <div class="d-flex justify-content-end mb-3">Me gusta&nbsp;<i class="far fa-heart"></i></div>
    </div>
</div>