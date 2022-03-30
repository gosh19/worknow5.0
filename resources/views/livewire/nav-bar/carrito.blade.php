<div class="w-full">
    <div class="mx-2 w-full flex justify-end ">
        <button class="hover:text-gray-400 p-3 transform hover:scale-105 transition duration-500 focus:outline-none"
            data-bs-toggle="modal" data-bs-target="#modal-carrito">
            <i class="fas fa-shopping-cart fa-2x"></i>
            <p class="absolute bottom-0 right-0 p-1 bg-pink-700 font-bold text-white rounded-full">{{count($courses)}}</p>
            @if (count($courses) >= 3)
                
            <div class="absolute top-9 left-0">
                <img src="{{ asset('img/inicio/50off.svg') }}" alt="">
            </div>
            @endif
        </button>
    </div>

</div>
