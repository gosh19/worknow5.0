<div wire:ignore.self class="modal fade " id="modal-carrito" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div wire:ignore.self class="modal-dialog modal-xl">
        <div wire:ignore.self class="modal-content ">
            
            <div class="modal-body ">
                <div class="flex justify-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="px-2 pt-2 pb-8 grid grid-cols-1 md:grid-cols-2 ">

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

                    <div class="col-span-1 pb-2 pt-3 flex justify-center">
                        <div class="text-center self-center">
                            <div class="grid grid-cols-3 justify-end">
                                <div class="col-span-2 md:col-span-1 md:col-start-2 h-6">
                                    <p class="text-md  text-left">Sub-total </p>
                                </div>
                                <div class="col-span-1 text-lg text-gray-700 font-extrabold h-6">{{session('country')}}${{ $total }}.00</div>

                                @if (count($courses) >= 3)
                                    @php
                                        $total = $total/2;
                                    @endphp
                                    <div class="col-span-3 md:col-span-2 md:col-start-2 py-0 h-6">
                                        <hr class="h-full">
                                    </div>
                                    <div class="col-span-2 md:col-span-1 md:col-start-2 h-6">
                                        <p class="text-md  text-left">Descuentos aplicados </p>
                                    </div>
                                    <div class="col-span-1 text-lg text-gray-700 font-extrabold line-through h-6">{{session('country')}}${{ $total }}.00</div>
                                @endif

                                <div class="col-span-3 md:col-span-2 md:col-start-2 py-0 h-6">
                                    <hr class="h-full">
                                </div>
                                <div class="col-span-1 md:col-span-1 md:col-start-2 h-6">
                                    <p class="text-md text-left">Total </p>
                                </div>
                                <div class="col-span-2 md:col-span-1 text-2xl text-pink-600 font-extrabold">{{session('country')}}${{ $total }}.00</div>
                                <div class="col-span-3 md:col-span-2 md:col-start-2 text-center">
                                    <div class="bg-indigo-600 rounded-xl  hover:bg-indigo-700 mt-3 py-3 px-3 w-full text-center ">

                                        <a href="{{ route('inscripcionTemprana') }}"
                                        class="modal-close text-white font-extrabold text-xl"
                                        style="text-decoration: none !important;">Comprar</a>
                                    </div>
                                </div>
                                <div class="col-span-3 md:col-span-2 md:col-start-2 text-center">
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
