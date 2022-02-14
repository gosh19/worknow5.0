<div>


    <div class="card post-foro flotante mb-3">
        <div class="card-body">
            <h3 class="mb-3 text-3xl"><i class="fas fa-user-circle"></i> {{$post->user->name}}</h3>
            <hr>
            <p style="font-size: 25px;">{{$post->text}}</p>
            <div class="mb-3">        
                @if (count($post->images) != 0)
                    @if (count($post->images) == 1)
                        <div class="row">
                            <div class="col">
                                <img style="max-width: 100%;" src="{{$post->images[0]->url}}">
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-8 ">
                                <div class="row justify-content-center">

                                    <img style="max-width: 100%;" src="{{$post->images[0]->url}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                @if (isset($post->images[1]))
                                    <div class="row">
                                        <img style="max-width: 100%;" src="{{$post->images[1]->url}}">
                                    </div>
                                @endif
                                @if (isset($post->images[2]))
                                    <div class="row">
                                        <img style="max-width: 100%;" src="{{$post->images[2]->url}}">
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                @else
                    <div></div>
                @endif
            </div>
            <hr>
            <div>

               @livewire('foro.like',['post'=> $post], key($post->id))
            </div>
            
            <hr>
            <div class="row p-3">
                @foreach ($comentarios as $j => $comment)
                    <div  class="card bg-comment mb-3 w-100">

                        @livewire('foro.comment',['post'=> $post, 'comment'=> $comment], key($comment->id))
                    </div>
                @endforeach

            </div>
            <hr>
            <div class="row p-3">
                <div class="w-100">

                    <div class="textwrapper">
                        <textarea maxlength="2500" cols="30" rows="4" wire:model.lazy="comment" placeholder="Dejar un comentario..."></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button wire:click="postComment" class="btn btn-primary">Cargar comentario</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>