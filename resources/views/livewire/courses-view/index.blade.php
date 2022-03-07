<div class="w-full">
    <div class="w-full  flex items-center justify-center md:h-screen">

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

            </div>{{--END MENU--}}
            
        </div>
    </div>
</div>
