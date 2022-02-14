<div class="row justify-content-around mg">
    <button wire:click="like()" style="border:0px; background:none;">
        <div>
            @if ($hasLike)
            <div  class="text-danger mt-3 mb-3">Me gusta <i class="fas fa-heart"></i> <span class="badge badge-danger">{{$cant}}</span></div>
            @else
            <div class="mt-3 mb-3" >Me gusta <i class="far fa-heart"></i> <span class="badge badge-dark">{{$cant}}</span></div>
            @endif
        </div>
    </button>
</div>
