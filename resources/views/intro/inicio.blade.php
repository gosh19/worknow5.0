@extends('layouts.app-alt')

@section('content')

    <body class="bg-blueGray-100 ">



        {{-- navBar --}}

        <div class="grid grid-cols-8 p-3 bg-white items-end md:items-center gap-3">
            <div class="col-start-1 col-span-6 lg:col-span-1 justify-self-center">
                <div><img class="w-full" src="{{ asset('img\inicio\logo-wn-2.png') }}" alt=""></div>
            </div>
            <div class="col-start-7 col-span-2 lg:col-span-1 justify-self-center block md:hidden">
                <button type="button" data-bs-toggle="collapse" data-bs-target="#collapse-menu" aria-expanded="false"
                    aria-controls="collapse-menu">
                    <i class="fa-solid fa-bars fa-2x"></i>
                </button>
            </div>
            <div class="col-start-2 lg:col-start-6 col-span-1 justify-self-center align-middle hidden md:block">
                <a href={{ route('Intro.Cursos') }}
                    class="no-underline hover:text-gray-400 text-center text-black p-3 transform hover:scale-105 transition duration-500">
                    Cursos
                </a>
            </div>
            <div class="col-start-4 lg:col-start-7 col-span-1 justify-self-center hidden md:block">

                @livewire('nav-bar.carrito')
            </div>
            <div class="col-span-1 justify-self-center hidden md:block">
                @livewire('nav-bar.select-country')
            </div>

            <div class="col-start-8 lg:col-start-9  col-span-3 lg:col-span-1 justify-self-end hidden md:block">

                <a href="{{ route('inscripcionTemprana') }}"
                style="text-decoration: none"
                    class="outline-none p-3 w-full text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-lg font-bold transform hover:scale-105 transition duration-500">
                    Registrarme
                </a>


            </div>

        </div>
        <div class="collapse collapse-horizontal absolute block md:hidden" id="collapse-menu">
            <div class="card card-body w-screen">
                <div class="grid grid-cols-7">
                    

                    <div class="col-span-1 justify-self-center">
                        <a href={{ route('Intro.Cursos') }}
                            class="no-underline hover:text-gray-400 text-black inline-block mt-3 transform hover:scale-105 transition duration-500">
                            Cursos
                        </a>
                    </div>
                    <div class="col-span-1 justify-self-center">

                        @livewire('nav-bar.carrito')
                    </div>
                    <div class="col-span-2 justify-self-end my-auto inline-block md:hidden">

                            @livewire('nav-bar.select-country')
                    </div>

                    <div class="col-span-3 justify-self-end flex items-center">

                        <a href="{{ route('inscripcionTemprana') }}"
                        style="text-decoration: none"
                            class="p-3 w-full text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-lg font-bold ">
                            Registrarme
                        </a>


                    </div>
                </div>
            </div>
        </div>


        {{-- MODAL LOGIN --}}
        <div class="modal fade" id="modal-ingreso" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="p-2">
                            <div class="text-center text-3xl text-blueGray-500">
                                Aula virtual
                            </div>
                            <form method="POST" action="/login">
                                @csrf
                                <div class="p-3">
                                    <div class="flex">
                                        <div class="mr-1 text-blueGray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="w-full">
                                            <input name="email" type="email"
                                                class="w-full border-b-2 focus:outline-none focus:border-transparent focus:border-coolGray-300"
                                                type="text" placeholder="Usuario">
                                        </div>
                                    </div>
                                </div>

                                <div class="p-3">
                                    <div class="flex">
                                        <div class="mr-1 text-blueGray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="w-full">
                                            <input name="password" type="password"
                                                class="w-full border-b-2 focus:outline-none focus:border-transparent focus:border-coolGray-300"
                                                placeholder="Contraseña">
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <input type="submit" value="Ingresar"
                                        class="text-xl focus:outline-none p-2 w-full text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-lg font-bold transform hover:scale-105 transition duration-500">
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- END MODAL LOGIN --}}




        {{-- registro --}}
        <div>
            <div class="grid grid-cols-2">
                <div
                    class="px-15 py-4 grid grid-flow-row col-span-2 lg:col-span-1 justify-items-center bg-gradient-to-tr from-blue-300 to-indigo-400">
                    <div class="p-1 text-white font-bold text-4xl text-center">
                        <h1>Registrate y forma parte de Work Now!</h1>
                    </div>

                    {{-- FORMULARIO DE REGISTRO --}}
                    <form method="POST" action="/login" class="w-2/3 md:w-1/2 ">
                        @csrf
                        <div class="py-3">
                            <input
                                class="p-2 w-full border-transparent focus:ring-indigo-400 focus:ring-4 focus:outline-none focus:border-transparent rounded-full text-center"
                                name="email" type="text" placeholder="Email..." required>
                        </div>
                        <div class="py-3">
                            <input
                                class="p-2 w-full border-transparent focus:ring-indigo-400 focus:ring-4 focus:outline-none focus:border-transparent rounded-full text-center"
                                name="password" type="password" placeholder="Contraseña..." required>
                        </div>
                        <div class="py-3 justify-self-center">
                            <input type="submit" value="Ingresar"
                                class="focus:outline-none focus-within p-2 w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-blue-600 rounded-xl shadow-lg transform hover:scale-105 transition duration-500">
                        </div>
                    </form>

                    <div class="w-full">
                        <div class="py-2 flex justify-center w-full">
                            <a href="{{ route('inscripcionTemprana') }}"
                        style="text-decoration: none"
                            class="w-1/2 block text-center px-3 py-2 text-white bg-pink-700 hover:bg-pink-900 rounded-xl shadow-lg font-bold">
                            Registrarme
                        </a>
                        </div>
                    </div>
                </div>


                {{-- Imagen  LA RESOLUCION ES 1024X768 --}}

                <div
                    class="col-span-2 lg:col-span-1 lg:visible sm:invisible bg-gradient-to-br  from-indigo-400 to-blue-300">
                    <img src="{{ asset('/storage/banners/banner-'.$bannerId??0) }}" alt="">
                </div>

            </div>
        </div>

        {{-- Iconos --}}

        <div class="grid grid-cols-1 md:grid-cols-3 py-3 ">
            <div class="col-span-1 py-3 md:py-15 divide-x-2">
                <div class="flex justify-center">
                    <div class="text-center">
                        <i class="far fa-clock text-blueGray-500 text-4xl"></i>
                        <p class="font-semibold">Duración del curso:</p>
                        <p>Con 2 horas semanales, lo terminas en 3 meses.</p>
                    </div>
                </div>
            </div>
            <div class="col-span-1 py-3 md:py-15 ">
                <div class="flex justify-center">
                    <div class="text-center">
                        <i class="fas fa-infinity text-blueGray-500 text-4xl"></i>
                        <p class="font-semibold">Habilitación de la plataforma:</p>
                        <p>Para toda la vida!</p>
                    </div>
                </div>
            </div>
            <div class="col-span-1 py-3 md:py-15 ">
                <div class="flex justify-center">
                    <div class="text-center">
                        <i class="fas fa-chalkboard-teacher text-blueGray-500 text-4xl"></i>
                        <p class="font-semibold">Profesores disponibles:</p>
                        <p>Campus virtual con profesores.</p>
                    </div>
                </div>
            </div>
        </div>


        <style>
            .top-100 {
                top: 100%
            }

            .bottom-100 {
                bottom: 100%
            }

            .max-h-select {
                max-height: 300px;
            }

        </style>




        {{-- Categorias de cursos --}}

        <div class="bg-gradient-to-tr pb-3 from-blue-300 to-indigo-400">
            <div class="text-white mx-20 pt-7 text-center">
                <h1 class="font-bold text-4xl">Nuestras capacitaciones</h1>
                <p class="font-semibold pt-2">Categorías de los cursos</p>
            </div>

            {{-- titulo de categoría --}}
            @foreach ($categorias as $categoria)
            @if ($loop->first)
                
            <div x-data="{open:true}">
            @else
            <div x-data="{open:false}">
            @endif
                    <div class="mx-10 mb-4">
                        <button x-on:click="open=!open" class=" border-b p-1 w-full text-left">
                            <div class="flex text-white justify-between">
                                <div>
                                    <h1 class="font-semibold text-2xl">{{ $categoria->name }}</h1>
                                </div>
                                <div class="text-xs p-2 ">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                            </div>
                        </button>
                    </div>

                    <div x-show="open" x-transition class="min-h-screen flex justify-center items-center py-10">
                        {{-- tarjetas --}}
                        <div class="md:px-4 md:grid md:grid-cols-2 lg:grid-cols-3 gap-5 space-y-4 md:space-y-0">

                            @foreach ($categoria->courses as $course)
                                @livewire('inscripcion.curso', ['course' => $course], key($course->id))
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        {{-- footer --}}
        <div class="grid grid-cols-6 p-6 bg-white items-center">
            <div class="col-span-2 md:col-span-1">
                <p>© WorkNow 2021</p>
            </div>
            <div class="col-span-1">
                <ul>
                    <li>
                        <a href="https://www.facebook.com/WorkNowcursos"><i
                                class="fab fa-facebook-f text-2xl text-blue-800"></i></a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/worknowcursos"><i
                                class="fab fa-instagram text-2xl text-blue-800"></i></a>
                    </li>
                    <li>
                        <a href="mailto:worknowcursos@gmail.com"><i class="far fa-envelope text-xl text-blue-800"></i></a>
                    </li>
                </ul>
            </div>
        </div>



    </body>
@endsection
