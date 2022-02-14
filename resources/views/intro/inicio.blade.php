@extends('layouts.app-alt')

@section('content')
<body class="bg-gray-200">
  
        
    
{{--TabBar--}}

    <div class="grid grid-cols-8 p-4 bg-white items-center">
        <div class="col-start-1 justify-self-center">Logo</div>
        <div class="col-start-5 col-span-1 justify-self-center"> 
          <button class="hover:text-gray-400 p-3">FAQ</button>
        </div>
        <div class="col-span-1 justify-self-center"> 
          <button class="hover:text-gray-400 p-3">Cursos</button>
        </div>
        <div class="col-span-1 justify-self-center"> 
          <button class="hover:text-gray-400 p-3">carrito</button>
        </div>
        <div class="col-span-1 justify-self-center">
          <button class="p-3 w-full text-white bg-indigo-600 hover:bg-indigo-700 py-1.5 rounded-xl shadow-lg">Ingresar al aula</button>
        </div>
    </div>

{{--registro--}}
    <div>
        <div class="grid grid-cols-2">
            <div class="p-20 grid grid-flow-row justify-items-center bg-gradient-to-tr from-blue-300 to-indigo-400">
                <div class="p-6"><h1>Registrate y forma parte de Work Now!</h1></div>
                <div class="p-3"><input class="border-transparent focus:ring-indigo-400 focus:ring-4 focus:outline-none focus:border-transparent rounded-full" type="text" value="Email"></div>
                <div class="p-3"><input class="border-transparent focus:ring-indigo-400 focus:ring-4 focus:outline-none focus:border-transparent rounded-full" type="password" value="******"></div>
                <div class="my-10 grid">    
                    <div class="p-2 justify-self-center">
                        <button class="p-3 w-full text-white bg-indigo-600 hover:bg-indigo-700 py-1.5 rounded-xl shadow-lg">
                            Registrarme gratis
                        </button>
                    </div>
                    <div class="p-2 justify-self-center">
                        <button class="bg-white text-black p-3 px-3 py-1 rounded-lg hover:bg-gray-100">
                            Continuar con Google
                        </button>
                    </div>    
                    <div class="p-2 justify-self-center">   
                        <button class="bg-transparent text-blue-700 p-3 px-3 py-1 rounded-lg">
                            Ya tengo cuenta!
                        </button>
                    </div> 
                </div>
            </div>
                

{{--Carrusel--}}
            <div class="col-span-1 bg-gray-400">
                    
            </div>
        </div>
    </div>

{{--Iconos--}}

    <div class="flex flex-wrap">
        <div class="flex justify-center py-24 w-1/3">
          <div><h1>Icono 1</h1></div>
        </div>
        <div class="flex justify-center py-24 w-1/3">
          <h1>Icono 1</h1>
        </div>
        <div class="flex justify-center py-24 w-1/3">
          <h1>Icono 1</h1>
        </div>        
    </div>


    <style>
      .top-100 {top: 100%}
      .bottom-100 {bottom: 100%}
      .max-h-select {
          max-height: 300px;
      }
  </style>
  
  {{--Selector categoria cursos--}}

  <div class="flex-auto flex flex-col items-center h-64">
      <div class="flex flex-col items-center relative">
          <div class="w-full  svelte-1l8159u">
              <div class="my-2 bg-white p-1 flex border border-gray-200 rounded svelte-1l8159u">
                  <div class="flex flex-auto flex-wrap"></div>
                  <input value="Javascript" class="p-1 px-2 appearance-none outline-none w-full text-gray-800  svelte-1l8159u">
                  <div>
                      <button class="cursor-pointer w-6 h-full flex items-center text-gray-400 outline-none focus:outline-none">
                          <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4">
                              <line x1="18" y1="6" x2="6" y2="18"></line>
                              <line x1="6" y1="6" x2="18" y2="18"></line>
                          </svg>
                      </button>
                  </div>
                  <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 svelte-1l8159u">
                      <button class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                          <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up w-4 h-4">
                              <polyline points="18 15 12 9 6 15"></polyline>
                          </svg>
                      </button>
                  </div>
              </div>
          </div>
          <div class="absolute shadow top-100 z-40 w-full lef-0 rounded max-h-select overflow-y-auto svelte-5uyqqj">
              <div class="flex flex-col w-full">
                  <div class="cursor-pointer w-full border-gray-100 rounded-t border-b 
              hover:bg-teal-100" style="">
                      <div class="flex w-full items-center p-2 pl-2 border-transparent bg-white border-l-2 relative hover:bg-teal-600 hover:text-teal-100 hover:border-teal-600">
                          <div class="w-full items-center flex">
                              <div class="mx-2 leading-6  ">Diseño y confección </div>
                          </div>
                      </div>
                  </div>
                  <div class="cursor-pointer w-full border-gray-100 border-b 
              hover:bg-teal-100 " style="">
                      <div class="flex w-full items-center p-2 pl-2 border-transparent bg-white border-l-2 relative hover:bg-teal-600 hover:text-teal-100 border-teal-600">
                          <div class="w-full items-center flex">
                              <div class="mx-2 leading-6  ">Diseño gráfico </div>
                          </div>
                      </div>
                  </div>
                  <div class="cursor-pointer w-full border-gray-100 rounded-b 
              hover:bg-teal-100 " style="">
                      <div class="flex w-full items-center p-2 pl-2 border-transparent bg-white border-l-2 relative  hover:bg-teal-600 hover:text-teal-100 hover:border-teal-600">
                          <div class="w-full items-center flex">
                              <div class="mx-2 leading-6  ">Programación </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>


{{--Tarjetas--}}
    <div class="min-h-screen bg-gradient-to-tr from-blue-300 to-indigo-400 flex justify-center items-center py-20">
        
      {{--Inicia tarjeta 1--}}
      <div class="md:px-4 md:grid md:grid-cols-2 lg:grid-cols-3 gap-5 space-y-4 md:space-y-0">
          <div class="max-w-sm bg-white px-6 pt-6 pb-2 rounded-xl shadow-lg transform hover:scale-105 transition duration-500">
            <div class="relative">
              <img class="w-full rounded-xl" src="https://images.unsplash.com/photo-1541701494587-cb58502866ab?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Colors" />
              <p class="absolute top-0 bg-red-500 text-white font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">20% desc</p>
            </div>
            <h1 class="mt-4 text-gray-800 text-3xl font-bold cursor-pointer">Javascript Bootcamp for Absolute Beginners </h1>
            <div class="my-4">
              <div class="flex space-x-1 items-center">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </span>
                <p>1:34:23 Minutes</p>
              </div>
              <div class="flex space-x-1 items-center">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                </span>
                <p>3 Parts</p>
              </div>
              <div class="flex space-x-1 items-center">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                  </svg>
                </span>
                <p>Vanilla JS</p>
              </div>
              <button class="mt-4 text-xl w-full text-white hover:bg-indigo-700 bg-indigo-600 py-1.5 rounded-xl shadow-lg">Añadir</button>
            </div>
          </div>
          <div class="max-w-sm bg-white px-6 pt-6 pb-2 rounded-xl shadow-lg transform hover:scale-105 transition duration-500">
             <div class="relative">
              <img class="w-full rounded-xl" src="https://images.unsplash.com/photo-1550684848-fac1c5b4e853?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1050&q=80" alt="Colors" />
              <p class="absolute top-0 bg-red-500 text-white font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">20% desc.</p>
            </div>
            <h1 class="mt-4 text-gray-800 text-3xl font-bold cursor-pointer">Write a Gatsby plugin using Typescript</h1>
            <div class="my-4">
              <div class="flex space-x-1 items-center">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </span>
                <p>1:34:23 Minutes</p>
              </div>
              <div class="flex space-x-1 items-center">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                </span>
                <p>3 Parts</p>
              </div>
              <div class="flex space-x-1 items-center">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                  </svg>
                </span>
                <p>TypeScript</p>
              </div>
              <button class="mt-4 text-xl w-full text-white hover:bg-indigo-700 bg-indigo-600 py-1.5 rounded-xl shadow-lg">Start Watching Now</button>
            </div>
          </div>
          <div class="max-w-sm bg-white px-6 pt-6 pb-2 rounded-xl shadow-lg transform hover:scale-105 transition duration-500">
            <div class="relative">
              <img class="w-full rounded-xl" src="https://images.unsplash.com/photo-1561835491-ed2567d96913?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1050&q=80" alt="Colors" />
              <p class="absolute top-0 bg-red-500 text-white font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">40% desc.</p>
            </div>
            <h1 class="mt-4 text-gray-800 text-3xl font-bold cursor-pointer">Advanced React Native for Sustainability</h1>
            <div class="my-4">
              <div class="flex space-x-1 items-center">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </span>
                <p>1:34:23 Minutes</p>
              </div>
              <div class="flex space-x-1 items-center">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                </span>
                <p>3 Parts</p>
              </div>
              <div class="flex space-x-1 items-center">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                  </svg>
                </span>
                <p>Vanilla JS</p>
              </div>
              <button class="hover:bg-indigo-700 mt-4 text-xl w-full text-white bg-indigo-600 py-1.5 rounded-xl shadow-lg">Añadir</button>
            </div>
          </div>
        </div>
      </div>


</body>
@endsection