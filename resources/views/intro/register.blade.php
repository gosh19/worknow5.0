@extends('layouts.app-alt')

@section('content')
    <div class="min-h-screen bg-gradient-to-tr from-blue-300 to-indigo-400">


        {{-- navBar --}}
        <div class="grid grid-cols-8 p-3 items-center gap-7 md:gap-0">
            <div class="col-start-1 col-span-8 md:col-span-1 justify-self-center">
                <a href="/">

                    <img src="{{ asset('img\inicio\logo-blanco.png') }}" alt="">
                </a>
            </div>

            <div class="md:col-start-5 col-span-2 md:col-span-1 justify-self-center">
                <button
                    class="text-white hover:text-blueGray-200 p-3 transform hover:scale-105 transition duration-500 focus:outline-none">
                    Cursos
                </button>
            </div>
            <div class="col-span-2 md:col-span-1 justify-self-center">
                @livewire('nav-bar.carrito')
            </div>
            <div class="col-start-7 col-span-1 justify-self-center">
                <button
                    class="p-3 w-full text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm font-bold transform hover:scale-105 transition duration-500 focus:outline-none">
                    Ingresar al aula
                </button>
            </div>
        </div>


        {{-- area de registro --}}
        <div>
            <div class="py-10">
                <div class="grid grid-cols-1 rounded-xl shadow-md w-full md:w-10/12 mx-auto">
                    <div class="col-span-1">
                        @livewire('inscripcion.formulario-inscripcion')
                    </div>
                </div>
            </div>
        </div>






    </div>
@endsection
