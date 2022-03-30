@extends('layouts.app-alt')

@section('content')

    <div class="min-h-screen bg-gradient-to-tr from-blue-300 to-indigo-400">


        {{-- navBar --}}
        <div class="grid grid-cols-8 p-3 items-center justify-end gap-7 md:gap-0">
            <div class="col-start-1 col-span-8 md:col-span-1 justify-self-center">
                <a href="/">

                    <img src="{{ asset('img\inicio\logo-blanco.png') }}" alt="">
                </a>
            </div>

            <div class="md:col-start-6 col-span-2 md:col-span-1 justify-self-center">
                <a href={{ route('Intro.Cursos') }}
                            class="no-underline hover:text-gray-400 text-white inline-block mt-3 transform hover:scale-105 transition duration-500">
                            Cursos
                        </a>
            </div>

        </div>


        {{-- area de registro --}}
        <div>
            <div class="py-10">
                <div class="grid grid-cols-1 rounded-xl shadow-md w-full md:w-10/12 mx-auto">
                    <div id="register" class="col-span-1">                        
                        <Index></Index>
                    </div>
                </div>
            </div>
        </div>





        <script src="https://sdk.mercadopago.com/js/v2"></script>
        <script>
            const mp = new MercadoPago('YOUR_PUBLIC_KEY');
            // Add step #3
        </script>
    </div>
@endsection
