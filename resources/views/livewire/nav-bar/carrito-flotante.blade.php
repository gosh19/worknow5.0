<div>
    <button class="hover:text-gray-400 p-3 fixed bottom-20 md:bottom-28 right-2 md:right-10 rounded-full z-50"
            data-bs-toggle="modal" data-bs-target="#modal-carrito">
        <img class="w-16" src="{{ asset('img/inicio/cart.svg') }}" alt="">
        <p class="absolute bottom-0 right-3 p-1 bg-pink-700 font-bold text-white rounded-full">{{count($courses)}}</p>
        @if (count($courses) >= 3)
            
            <div class="absolute top-9 left-0">
                <img src="{{ asset('img/inicio/50off.svg') }}" alt="">
            </div>
        @endif        
    </button>
</div>
