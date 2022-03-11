<div class="w-full">
    <div class="mx-2 w-full flex justify-end ">

        <button class="hover:text-gray-400 p-3 transform hover:scale-105 transition duration-500 focus:outline-none hidden md:block"
            data-bs-toggle="modal" data-bs-target="#modal-carrito">
            <i class="fas fa-shopping-cart fa-2x"></i>
            <p class="absolute bottom-0 right-0 p-1 bg-pink-700 font-bold text-white rounded-full">{{count($courses)}}</p>
        </button>
        <button class="hover:text-gray-400 p-3  md:hidden block"
                type="button" data-bs-toggle="collapse" data-bs-target="#collapse-carrito" aria-expanded="false"
                aria-controls="collapse-carrito">
            <i class="fas fa-shopping-cart fa-2x"></i>
        </button>
    </div>
    <button class="hover:text-gray-400 p-3 fixed bottom-36 right-12 bg-purple-200 rounded-full z-50 border-4 border-purple-700 hidden md:block "
            data-bs-toggle="modal" data-bs-target="#modal-carrito">
        <i class="fas fa-shopping-cart fa-2x"></i>
        <p class="absolute bottom-0 right-0 p-1 bg-pink-700 font-bold text-white rounded-full">{{count($courses)}}</p>
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
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Lista de cursos seleccionados</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-2">

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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
