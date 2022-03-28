<div class="w-full">
    <div class="mx-2 w-full flex justify-end ">

        <button class="hover:text-gray-400 p-3 transform hover:scale-105 transition duration-500 focus:outline-none hidden md:block"
            data-bs-toggle="modal" data-bs-target="#modal-carrito">
            <i class="fas fa-shopping-cart fa-2x"></i>
            <p class="absolute bottom-0 right-0 p-1 bg-pink-700 font-bold text-white rounded-full">{{count($courses)}}</p>
            @if (count($courses) >= 3)
                
            <div class="absolute top-9 left-0">
                <img src="{{ asset('img/inicio/50off.svg') }}" alt="">
            </div>
            @endif
        </button>
        <button class="hover:text-gray-400 p-3  md:hidden block"
                type="button" data-bs-toggle="collapse" data-bs-target="#collapse-carrito" aria-expanded="false"
                aria-controls="collapse-carrito">
            <i class="fas fa-shopping-cart fa-2x"></i>
        </button>
    </div>
    <button class="hover:text-gray-400 p-3 fixed bottom-28 right-10 rounded-full z-50"
            data-bs-toggle="modal" data-bs-target="#modal-carrito">
            <img class="w-16" src="{{ asset('img/inicio/cart.svg') }}" alt="">
            <p class="absolute bottom-0 right-0 p-1 bg-pink-700 font-bold text-white rounded-full">{{count($courses)}}</p>
        @if (count($courses) >= 3)
            
            <div class="absolute top-9 left-0">
                <img src="{{ asset('img/inicio/50off.svg') }}" alt="">
            </div>
        @endif        
    </button>
    <div wire:ignore.self class="collapse absolute w-screen right-0 z-50" id="collapse-carrito">
        <div class="p-2 bg-white">

            @php
                $total = 0;
            @endphp
            <div class="w-full">
                @foreach ($courses as $key => $course)
                    @php
                        $total += $prices[$key];
                    @endphp
                    <div class="grid grid-cols-6 border-b py-2">
                        <div class="col-span-6 md:col-span-1 mx-2 mt-2">
                            <img class="rounded-lg" src="{{ asset($course['url_img']) }}" alt="">
                        </div>
                        <div class="col-span-4 md:col-span-4 mx-2">
                            <div class="grid grid-rows-2 lg:grid-rows-1">
                                <div class="row-span-1">
                                    <h1 class="text-lg font-bold">{{ $course['nombre'] }}</h1>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-span-6 md:col-span-1 md:col-start-6 mx-2 mt-2 text-blueGray-600 flex justify-between items-center">
                            <div class="p-3 text-lg">
                                <p>{{ '$' . number_format($prices[$key], 2, '.', ',') }}</p>
                            </div>
                            <div>
                                <button wire:click="remove({{ $key }})" class="p-3 outline-none">
                                    <i class="fas fa-trash-alt "></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-6 border-b pb-2 pt-3">
                <div class="col-span-2 col-start-5 md:col-start-6 text-center">
                    <p class="text-lg font-bold">Total ${{ $total }}</p>
                </div>
            </div>
            <div class="flex justify-end pb-2 pt-3 ">
                <div class="text-center">
                    <a href="{{ route('inscripcionTemprana') }}"
                        class="modal-close bg-indigo-600 rounded-xl text-white hover:bg-indigo-700 py-2 px-3 w-40 text-center "
                        style="text-decoration: none !important;">Registrarme</a>
                </div>
            </div>
        </div>
        <div class="bg-gray-300 flex justify-center">
            <button class="hover:text-gray-400 p-3 transform hover:scale-105 transition duration-500 focus:outline-none"
                type="button" data-bs-toggle="collapse" data-bs-target="#collapse-carrito" aria-expanded="false"
                aria-controls="collapse-carrito">
                <i class="fa-solid fa-angles-up"></i>
        </button>
        </div>
    </div>
    
    {{-- <div id="carrito-flotante"
        class="fixed bottom-5 right-5 z-50 text-5xl bg-gray-100  rounded-full border-4 border-indigo-300 p-3 text-blue-400"
        @click="isDialogOpen = true">
        <i class="fas fa-shopping-cart"></i>
        <div class="absolute bottom-0 right-0 text-white opacity-70">
            <p class="bg-gradient-to-tr from-blue-800 to-indigo-700 text-3xl p-1 rounded-full">{{count($courses)}}</p>
        </div>
    </div> --}}

    <div wire:ignore.self class="modal fade " id="modal-carrito" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div wire:ignore.self class="modal-dialog modal-xl">
            <div wire:ignore.self class="modal-content ">
                
                <div class="modal-body ">
                    <div class="flex justify-end">

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="px-2 pt-2 pb-8 grid grid-cols-2 ">

                        @php
                            $total = 0;
                        @endphp
                        <div class="col-span-1">

                            <div >
                                <p class="text-3xl font-bold text-gray-600">Tu carrito de compras</p>
                                <p>Tienes {{count($courses)}} item en tu carrito</p>
                            </div>
                            <div id="course-cart-box" class="w-full overflow-y-scroll max-h-52">
                                @foreach ($courses as $key => $course)
                                    @php
                                        $total += $prices[$key];
                                    @endphp
                                    <div class="grid grid-cols-6 border-b border-purple-200 py-2">
                                        <div class="col-span-6 md:col-span-1 mx-2 mt-2">
                                            <img class="rounded-lg" src="{{ asset($course['url_img']) }}" alt="">
                                        </div>
                                        <div class="col-span-4 md:col-span-4 mx-2">
                                            <div class="grid grid-rows-2">
                                                <div class="row-span-1">
                                                    <h1 class="text-lg text-gray-600 font-bold">{{ $course['nombre'] }}</h1>
                                                </div>
                                                <div class="row-span-1 text-lg text-gray-500">
                                                    <p>{{ '$' . number_format($prices[$key], 2, '.', ',') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="col-span-6 md:col-span-1 mx-2 mt-2 text-blueGray-600 flex justify-between">
                                            
                                            <div>
                                                <button wire:click="remove({{ $key }})">
                                                    <i class="fas fa-trash-alt text-purple-300"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-span-1 pb-2 pt-3 flex">
                            <div class="text-center self-center">
                                <div class="grid grid-cols-3 justify-end">
                                    <div class="col-span-1 col-start-2 h-6">
                                        <p class="text-md  text-left">Sub-total </p>
                                    </div>
                                    <div class="col-span-1 text-lg text-gray-700 font-extrabold h-6">{{session('country')}}${{ $total }}.00</div>

                                    @if (count($courses) >= 3)
                                        @php
                                            $total = $total/2;
                                        @endphp
                                        <div class="col-span-2 col-start-2 py-0 h-6">
                                            <hr class="h-full">
                                        </div>
                                        <div class="col-span-1 col-start-2 h-6">
                                            <p class="text-md  text-left">Descuentos aplicados </p>
                                        </div>
                                        <div class="col-span-1 text-lg text-gray-700 font-extrabold line-through h-6">{{session('country')}}${{ $total }}.00</div>
                                    @endif

                                    <div class="col-span-2 col-start-2 py-0 h-6">
                                        <hr class="h-full">
                                    </div>
                                    <div class="col-span-1 col-start-2 h-6">
                                        <p class="text-md text-left">Total </p>
                                    </div>
                                    <div class="col-span-1 text-2xl text-pink-600 font-extrabold">{{session('country')}}${{ $total }}.00</div>
                                    <div class="col-span-2 col-start-2 text-center">
                                        <div class="bg-indigo-600 rounded-xl  hover:bg-indigo-700 mt-3 py-3 px-3 w-full text-center ">

                                            <a href="{{ route('inscripcionTemprana') }}"
                                            class="modal-close text-white font-extrabold text-xl"
                                            style="text-decoration: none !important;">Comprar</a>
                                        </div>
                                    </div>
                                    <div class="col-span-2 col-start-2 text-center">
                                        <div class="mt-3 py-1 px-3 w-full text-center ">

                                            <a href={{ route('Intro.Cursos') }}
                                            class="modal-close font-bold text-xl text-blue-500"
                                            style="text-decoration: none !important;">Seguir comprando <i class="fa-solid fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
