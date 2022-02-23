@extends('layouts.app-alt')

@section('content')

    <body class="bg-blueGray-100 ">



        {{-- navBar --}}

        <div class="grid grid-cols-8 p-3 bg-white items-center gap-3">
            <div class="col-start-1 col-span-8 lg:col-span-1 justify-self-center">
                <div><img class="w-full" src="{{ asset('img\inicio\logo-wn.png') }}" alt=""></div>
            </div>

            <div class="col-start-2 lg:col-start-6 col-span-1 justify-self-center">
                <a href={{ route('Intro.Cursos') }}
                    class="no-underline hover:text-gray-400 text-black p-3 transform hover:scale-105 transition duration-500">
                    Cursos
                </a>
            </div>
            <div class="col-start-4 lg:col-start-7 col-span-1 justify-self-center">

                @livewire('nav-bar.carrito')
            </div>


            <div class="col-start-8 lg:col-start-9  col-span-3 lg:col-span-1 justify-self-end" x-data="{ 'ingreso': false }"
                @keydown.escape="ingreso = false">
                <button @click="ingreso = true"
                    class="focus:outline-none p-3 w-full text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-lg font-bold transform hover:scale-105 transition duration-500">
                    Ingresar al aula
                </button>

                {{-- modal ingreso al aula --}}
                <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="ingreso" x-transition
                    :class="{ 'absolute inset-0 z-10 flex items-start justify-center': ingreso }">
                    <div class="bg-white w-1/3 mx-auto rounded shadow-lg py-4 text-left px-6 my-3 self-center"
                        x-show="ingreso" @click.away="ingreso = false">
                        <div class="flex justify-end items-center p-2 text-xl">
                            <button type="button" @click="ingreso = false">
                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                                    height="18" viewBox="0 0 18 18">
                                    <path
                                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </button>
                        </div>
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
                                <div class="mt-2">
                                    <button
                                        class="text-md focus:outline-none p-2 w-full text-blueGray-500 bg-transparent hover:bg-indigo-700 transform hover:scale-105 transition duration-500">
                                        Olvidé mi contraseña
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- End modal --}}
            </div>
            {{-- fin modal ingreso al aula --}}
        </div>




        {{-- registro --}}
        <div>
            <div class="grid grid-cols-2">
                <div
                    class="px-15 py-4 grid grid-flow-row col-span-2 lg:col-span-1 justify-items-center bg-gradient-to-tr from-blue-300 to-indigo-400">
                    <div class="p-1 text-white font-bold text-4xl text-center">
                        <h1>Registrate y forma parte de Work Now!</h1>
                    </div>

                    {{-- FORMULARIO DE REGISTRO --}}
                    <form action="{{ route('inscripcionTemprana') }}" method="POST">
                        @csrf
                        <div class="py-3">
                            <input
                                class="p-2 w-full border-transparent focus:ring-indigo-400 focus:ring-4 focus:outline-none focus:border-transparent rounded-full"
                                name="email" type="text" placeholder="Email..." required>
                        </div>
                        <div class="py-3">
                            <input
                                class="p-2 w-full border-transparent focus:ring-indigo-400 focus:ring-4 focus:outline-none focus:border-transparent rounded-full"
                                name="password" type="password" placeholder="Contraseña..." required>
                        </div>
                        <div class="py-3 justify-self-center">
                            <input type="submit" value="Registrarme gratis"
                                class="focus:outline-none focus-within p-2 w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-blue-600 rounded-xl shadow-lg transform hover:scale-105 transition duration-500">
                        </div>
                    </form>

                    <div class="">
                        {{-- <div class="p-1 justify-self-center">
                            <button
                                class="focus:outline-none p-2 w-full text-black rounded-xl bg-gray-50 hover:bg-gray-200 transform hover:scale-105 transition duration-500">
                                Continuar con Google
                            </button>
                        </div> --}}
                        <div class="py-2 justify-self-center">
                            <button
                                class="focus:outline-none p-2 w-full bg-transparent text-blue-700 hover:text-blue-900 px-3 py-1 rounded-lg transform hover:scale-105 transition duration-500">
                                Ya tengo cuenta!
                            </button>
                        </div>
                    </div>
                </div>


                {{-- Imagen  LA RESOLUCION ES 1024X768 --}}
                <div
                    class="col-span-2 lg:col-span-1 lg:visible sm:invisible bg-gradient-to-br  from-indigo-400 to-blue-300">
                    <div id="carouselExampleSlidesOnly" class="carousel slide flex items-center h-full"
                        data-bs-ride="carousel">
                        <div class="carousel-inner relative w-full overflow-hidden">
                            <div class="carousel-item active relative float-left w-full">
                                <img src="{{ asset('storage/inicio/1.png') }}" class="block w-full" alt="Work-Now-1" />
                            </div>
                            <div class="carousel-item relative float-left w-full">
                                <img src="{{ asset('storage/inicio/2.png') }}" class="block w-full" alt="Work-Now-2" />
                            </div>
                            <div class="carousel-item relative float-left w-full">
                                <img src="{{ asset('storage/inicio/3.png') }}" class="block w-full" alt="Work-Now-3" />
                            </div>
                        </div>
                    </div>
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
        <div class="w-full h-2 bg-blue-600"></div>
        <div class="text-center bg-gradient-to-br from-blue-100 to-purple-100 py-2">
            <p class="text-4xl font-bold text-blue-900">Top 5 <i class="fa-solid fa-fire text-red-900"></i></p>
        </div>

        <div class="border-t-4 border-b-4 border-purple-300 grid grid-cols-1 md:grid-cols-5 divide-y-2 md:divide-y-0 md:divide-x-2 divide-black">
                @php
                    $cant = 0;
                @endphp
            @foreach ($masElegidos as $key => $elegido)
                <div class="col-span-1 h-32 flex items-center" style="background: no-repeat center url({{ $elegido['img'] }});">
                    <div class="w-full text-center bg-gray-700 " style="background-color: rgba(91, 63, 117, 0.712)">

                        <p class="text-white text-lg font-bold">{{ $elegido['nombre'] }}</p>
                    </div>

                </div>
                @php
                    $cant++;
                    if ($cant >= 5) {
                        break;
                    }
                @endphp
            @endforeach
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
                <div x-data="{open:false}">
                    <div class="mx-10 mb-4">
                        <button x-on:click="open=!open" class=" border-b p-1 w-full text-left focus:outline-none">
                            <div class="flex text-white">
                                <div>
                                    <h1 class="font-semibold text-2xl">{{ $categoria->name }}</h1>
                                </div>
                                <div class="text-xs p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
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
