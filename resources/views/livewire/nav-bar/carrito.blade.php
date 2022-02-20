<div  x-data="{ isDialogOpen: false}" class="mx-2 w-full flex justify-end " @keydown.escape="isDialogOpen = false">
    <button
        class="hover:text-gray-400 p-3 transform hover:scale-105 transition duration-500 focus:outline-none"
        @click="isDialogOpen = true">
        <i class="fas fa-shopping-cart fa-2x"></i>
    </button>

    <div id="carrito-flotante"
        class="fixed bottom-5 right-5 z-50 text-5xl bg-gray-100  rounded-full border-4 border-indigo-300 p-3 text-blue-400"
        @click="isDialogOpen = true">
        <i class="fas fa-shopping-cart"></i>
        <div class="absolute bottom-0 right-0 text-white opacity-70">
            <p class="bg-gradient-to-tr from-blue-800 to-indigo-700 text-3xl p-1 rounded-full">{{count($courses)}}</p>
        </div>
    </div>

    {{-- modal carrito --}}
    <div wire:ignore.self class="overflow-auto " style="background-color: rgba(0,0,0,0.5)" x-show="isDialogOpen"
        x-transition
        :class="{ 'fixed w-full inset-0 z-10 flex items-start justify-center': isDialogOpen }">
        <div class="bg-white w-3/4 mx-auto rounded shadow-lg py-4 text-left px-6 my-3"
            x-show="isDialogOpen" @click.away="isDialogOpen = false">
            <div class="flex justify-between items-center border-b p-2 text-xl">
                <h6 class="text-xl font-bold">Carrito de compras</h6>
                <button type="button" @click="isDialogOpen = false">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg"
                        width="18" height="18" viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-2">
                {{-- descripción compra - cada curso --}}
                @php
                    $total = 0;
                @endphp
                <div class="w-full">
                    @foreach ($courses as $key => $course)
                        @php
                            $total += $course->info->getPrecio($country);
                        @endphp
                        <div class="grid grid-cols-6 border-b py-2">
                            <div class="col-span-2 mx-2 mt-2">
                                <img class="rounded-lg" src="{{ asset($course['url_img']) }}"
                                    alt="">
                            </div>
                            <div class="col-span-4 md:col-span-4 mx-2">
                                <div class="grid grid-rows-2 lg:grid-rows-1">
                                    <div class="row-span-1">
                                        <h1 class="text-lg font-bold">{{ $course['nombre'] }}</h1>
                                    </div>
                                    <div class="hidden lg:block ">


                                        <p class="leading-tight text-sm">{!! $course['descripcion'] !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-span-6 md:col-span-1 md:col-start-6 mx-2 mt-2 text-blueGray-600 flex justify-between items-center border-t-2 border-blue-100">
                                <div class="p-3 text-lg">
                                    <h1>{{ '$'.number_format($course->info->getPrecio($country), 2, '.', ',') }}</h1>
                                </div>
                                <div>
                                    <button class="p-3 focus:outline-none"><i
                                            class="fas fa-trash-alt "></i></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="grid grid-cols-6 border-b pb-2 pt-3">
                    <div class="col-span-2 col-start-6 text-center">
                        <h1 class="text-lg font-bold">Total ${{ $total }}</h1>
                    </div>
                </div>
                <div class="flex justify-end pb-2 pt-3 ">
                    <div class="text-center">
                        <a  href="{{route('inscripcionTemprana')}}"
                            class="modal-close bg-indigo-600 rounded-xl text-white hover:bg-indigo-700 py-2 px-3 w-40 text-center">Registrarme gratis</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- fin modal carrito --}}


</div>

