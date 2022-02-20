<div class="w-full">
    <div class="w-full  flex items-center justify-center md:h-screen" x-data="{ showModal: @entangle('showModal') }"
        @keydown.escape="showModal = false" x-cloak>

        <div class="w-full h-24 md:h-screen md:flex bg-gradient-to-tr from-blue-400 to-indigo-500 md:bg-none">

            {{-- categorias de cursos - nav --}}
            <nav class="w-screen  md:w-60 rounded-br-3xl pb-3 md:bg-gradient-to-tr from-blue-400 to-indigo-500">
                <div class="w-56 p-10 justify-center ">
                    <a href="{{ route('intro', ['country' => session('country')]) }}"
                        class="text-center transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                        <img class="" src="{{ asset('img\inicio\logo-blanco.png') }}" alt="">
                    </a>
                </div>
                <div >
                    @livewire('courses-view.categorias', ['categorias' => $categorias])
                </div>
            </nav>

            <div class="w-full lg:w-screen">
                {{-- buscador-carrito-ingresar --}}
                <div class="flex justify-between md:justify-end items-center mr-4 border-0 md:border-b-2 border-gray-300 w-full md:w-auto">

                    <div >
                        @livewire('nav-bar.carrito')
                    </div>
                    
                    <div class="justify-self-center mx-2">
                        <button
                            class="px-3 py-2 w-full text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm font-bold transform hover:scale-105 transition duration-500 focus:outline-none">
                            Ingresar al aula
                        </button>
                    </div>
                </div>

                {{-- tarjetas de cursos --}}
                <div class="p-3">
                    @livewire('courses-view.courses', ['categoria' => $selectedCategoria])


                </div>

                {{-- modal cursos --}}

                <div class="overflow-auto w-full" style="background-color: rgba(0,0,0,0.5)" x-show="showModal"
                    :class="{ 'fixed inset-0 z-10 flex items-center justify-center': showModal }">
                    <div class="bg-white w-screen md:w-2/5 mx-auto rounded shadow-lg py-4 text-left px-6 ">
                        @if ($selectedCourse)


                            <div class="flex justify-between items-center border-b p-2 text-xl ">
                                <p class="text-xl font-bold mr-2">{{ $selectedCourse->nombre }}</p>
                                <div class="cursor-pointer z-50" @click="showModal = false">
                                    <i class="fas fa-times fa-2x"></i>
                                </div>
                            </div>
                            <div class="aspect-w-16 aspect-h-9 mt-3">
                                @if ($selectedCourse->videoMuestra)

                                    <iframe autoplay width="853" height="480"
                                        src="{{ $selectedCourse->videoMuestra->url }}" title="YouTube video player"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                @else
                                    <img src="{{ $selectedCourse->url_img }}" alt="" srcset="">
                                @endif
                            </div>
                            <div class="flex justify-center bg-blueGray-200 px-3 py-1 text-blueGray-600">
                                <div class="px-4 flex items-center">
                                    <h1><i class="fas fa-certificate text-lightBlue-700"></i> Certificación oficial</h1>
                                </div>
                                <div class="px-4 col-span-1 flex items-center">
                                    <h1><i class="fas fa-star text-yellow-500"></i>
                                        {{ $selectedCourse->info->score == null ? rand(1500, 5000) : $selectedCourse->info->score }}
                                    </h1>
                                </div>
                                <div class="px-4 col-span-1 flex items-center">
                                    <h1><i class="fas fa-users"></i>
                                        {{ $selectedCourse->info->people == null ? rand(1500, 5000) : $selectedCourse->info->people }}
                                        alumnos</h1>
                                </div>
                            </div>
                            <p class="leading-tight py-3 text-lg">
                                {!! $selectedCourse->descripcion !!}
                            </p>
                            <div class="flex justify-end pt-2 text-lg font-semibold">
                                <button
                                    class="modal-close bg-indigo-600 rounded-xl text-white hover:bg-indigo-700 py-1.5 w-40 mx-2"
                                    wire:click="add({{ $selectedCourse->id }})">{{ $btnText }}</button>
                                <a href="{{ route('inscripcionTemprana') }}"
                                    class="modal-close bg-indigo-600 rounded-xl text-center text-white hover:bg-indigo-700 py-1.5 w-40">Ir
                                    al registro</a>
                            </div>
                        @else
                            <div>
                                <p>CARGANDO </p>
                                <div class="cursor-pointer z-50" @click="showModal = false">
                                    <i class="fas fa-spinner fa-2x animate-spin"></i>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>{{--END MENU--}}
            
        </div>
    </div>
</div>
