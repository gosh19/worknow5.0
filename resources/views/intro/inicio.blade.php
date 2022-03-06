@extends('layouts.app-alt')

@section('content')

    <body class="bg-blueGray-100 ">



        {{-- navBar --}}

        <div class="grid grid-cols-8 p-3 bg-white items-end md:items-center gap-3">
            <div class="col-start-1 col-span-6 lg:col-span-1 justify-self-center">
                <div><img class="w-full" src="{{ asset('img\inicio\logo-wn.png') }}" alt=""></div>
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


            <div class="col-start-8 lg:col-start-9  col-span-3 lg:col-span-1 justify-self-end hidden md:block">

                <button type="button"
                    class="focus:outline-none p-3 w-full text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-lg font-bold transform hover:scale-105 transition duration-500"
                    data-bs-toggle="modal" data-bs-target="#modal-ingreso">
                    Ingresar al aula
                </button>


            </div>

        </div>
        <div class="collapse collapse-horizontal absolute" id="collapse-menu">
            <div class="card card-body w-screen">
                <div class="grid grid-cols-6">

                    <div class="col-span-1 justify-self-center">
                        <a href={{ route('Intro.Cursos') }}
                            class="no-underline hover:text-gray-400 text-black inline-block mt-3 transform hover:scale-105 transition duration-500">
                            Cursos
                        </a>
                    </div>
                    <div class="col-span-1 justify-self-center">

                        @livewire('nav-bar.carrito')
                    </div>


                    <div class="col-span-4 justify-self-end">

                        <button type="button"
                            class="focus:outline-none p-3 w-full  bg-indigo-600 text-white hover:bg-indigo-700 rounded-xl shadow-lg font-bold transform hover:scale-105 transition duration-500"
                            data-bs-toggle="modal" data-bs-target="#modal-ingreso">
                            Ingresar al aula
                        </button>


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
                                {{-- <div class="mt-2">
                                    <button
                                        class="text-md focus:outline-none p-2 w-full text-blueGray-500 bg-transparent hover:bg-indigo-700 transform hover:scale-105 transition duration-500">
                                        Olvidé mi contraseña
                                    </button>
                                </div> --}}
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
                    <form action="{{ route('inscripcionTemprana') }}" method="POST" class="w-2/3 md:w-1/2 ">
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
                            <input type="submit" value="Registrarme"
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
                                data-bs-toggle="modal" data-bs-target="#modal-ingreso"
                                class="focus:outline-none p-2 w-full bg-transparent text-blue-700 hover:text-blue-900 px-3 py-1 rounded-lg transform hover:scale-105 transition duration-500">
                                Ya tengo cuenta!
                            </button>
                        </div>
                    </div>
                </div>


                {{-- Imagen  LA RESOLUCION ES 1024X768 --}}

                <div
                    class="col-span-2 lg:col-span-1 lg:visible sm:invisible bg-gradient-to-br  from-indigo-400 to-blue-300">
                    <img src="{{ asset('img/inicio/banner-inicio.jpeg') }}" alt="">
                    {{-- <div id="carouselExampleSlidesOnly" class="carousel slide flex items-center h-full"
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
                    </div> --}}
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
        {{--
        <div class="w-full h-2 bg-blue-600"></div>

        <div class="text-center flex justify-center py-2">
            <p class="text-4xl font-bold text-black mr-3">
                Top 5
            </p>
            <svg xmlns="http://www.w3.org/2000/svg" width="45" viewBox="0 0 375 375" height="45" version="1.0">
                <defs>
                    <clipPath id="a">
                        <path d="M 48.914062 11.445312 L 309 11.445312 L 309 359 L 48.914062 359 Z M 48.914062 11.445312" />
                    </clipPath>
                </defs>
                <g clip-path="url(#a)">
                    <path fill="#F1473A"
                        d="M 181.066406 358.289062 C 145.253906 358.289062 56.742188 352.703125 48.902344 250.988281 C 48.902344 250.988281 71.828125 291.519531 71.863281 286.757812 C 71.972656 271.285156 48.902344 214.660156 106.578125 176.097656 C 177.164062 128.914062 155.863281 71.03125 139.0625 69.914062 C 139.0625 69.914062 184.230469 65.351562 188.347656 125.132812 C 190.582031 157.65625 218.027344 63.765625 201.789062 11.792969 C 201.789062 11.792969 284.25 55.382812 274.027344 162.683594 C 274.027344 162.683594 286.769531 138.378906 308.1875 151.367188 C 308.1875 151.367188 294.746094 155.980469 299.230469 191.75 C 303.707031 227.515625 323.304688 358.289062 181.066406 358.289062" />
                </g>
                <path fill="#F79326"
                    d="M 170.425781 354.578125 C 147.277344 353.523438 103.222656 348.429688 103.222656 290.867188 C 103.222656 233.304688 160.90625 225.476562 160.90625 172.386719 C 160.90625 172.386719 188.34375 181.886719 185.546875 208.15625 C 185.546875 208.15625 239.304688 174.625 234.824219 134.941406 C 234.824219 134.941406 351.121094 362.828125 170.425781 354.578125" />
                <path fill="#F79326"
                    d="M 170.425781 354.578125 C 147.277344 353.523438 103.222656 348.429688 103.222656 290.867188 C 103.222656 233.304688 160.90625 225.476562 160.90625 172.386719 C 160.90625 172.386719 188.34375 181.886719 185.546875 208.15625 C 185.546875 208.15625 239.304688 174.625 234.824219 134.941406 C 234.824219 134.941406 351.121094 362.828125 170.425781 354.578125" />
                <path fill="#FFF533"
                    d="M 181.625 255.429688 C 181.625 255.429688 195.625 296.394531 172.664062 296.394531 C 156.703125 296.394531 158.660156 279.074219 158.660156 279.074219 C 158.660156 279.074219 114.140625 351.164062 181.625 351.164062 C 195.292969 351.164062 219.148438 348.371094 219.148438 311.484375 C 219.148438 274.601562 198.421875 259.726562 181.625 255.429688" />
            </svg>
        </div>

        <div
            class="md:px-32 md:py-6 border-t-4 grid grid-cols-1 md:grid-cols-5 md:gap-y-3 gap-x-4 divide-y-2 items-center justify-items-center bg-white">
            @php
                $cant = 0;
                $heights = [80, 64, 64, 52, 52];
                $order = [3, 2, 4, 1, 5];
            @endphp
            @foreach ($masElegidos as $key => $elegido)
                <div class="col-span-1 w-full md:order-{{ $order[$cant] }} h-40 md:h-{{ $heights[$cant] }} md:w-44 rounded-2xl flex items-center justify-center"
                    style="background: no-repeat center url({{ $elegido['img'] }});">
                    <div class="w-full text-center bg-gray-700 " style="background-color: rgba(63, 62, 62, 0.829)">

                        <p class="text-white text-lg font-bold pt-1">{{ $elegido['nombre'] }}</p>
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
 --}}

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
