@extends('layouts.app-alt')

@section('content')
    
{{--navBar--}}

<div class="grid grid-cols-8 p-3 bg-white items-center">
  <div class="col-start-1 justify-self-center">
    <div><img src="{{ asset('img\inicio\logo-wn.png') }}" alt=""> </div>
  </div>
  <div class="col-start-5 col-span-1 justify-self-center"> 
    <button class="hover:text-gray-400 p-3 transform hover:scale-105 transition duration-500 focus:outline-none">
      FAQ
    </button>
  </div>
  <div class="col-span-1 justify-self-center"> 
    <button class="hover:text-gray-400 p-3 transform hover:scale-105 transition duration-500 focus:outline-none">
      Cursos
    </button>
  </div>
  <div class="col-span-1 justify-self-center"> 
    <button class="hover:text-gray-400 p-3 transform hover:scale-105 transition duration-500 focus:outline-none">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
          <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
        </svg>
  </button>
  </div>
  <div class="col-span-1 justify-self-center">
    <button class="p-3 w-full text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm font-bold transform hover:scale-105 transition duration-500 focus:outline-none">
      Ingresar al aula
    </button>
  </div>
</div>

{{--todo--}}
<div class="grid grid-cols-3 bg-blueGray-100">
  <div class="col-span-2 ">
    
    {{--curso--}}
      <div class="p-3">
          <div class="py-2">
            <div class="text-left text-blueGray-600 font-bold text-4xl">
              Adobe Illustrator desde 0
            </div>
          </div>
      </div>

      {{--video--}}
      <div class="p-3 col-span-1">
        <div class="aspect-w-16 aspect-h-9">
          <iframe width="853" height="480" src="https://www.youtube.com/embed/Yx-ytGJwB9Y" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>

          {{--calificacion curso--}}
          <div class="grid grid-cols-3 bg-blueGray-200 px-3 mx-3 py-1 text-blueGray-600">
            <div class="col-span-1 flex items-center">
               <h1><i class="fas fa-certificate text-lightBlue-700"></i> Certificación oficial</h1>
            </div>
            <div class="col-span-1 flex items-center">
               <h1><i class="fas fa-users"></i> 3829 alumnos</h1>
             </div>
            <div class="col-span-1 flex items-center">
               <h1><i class="fas fa-star text-yellow-500"></i> 4.6</h1>
            </div>      
          </div>



    {{--temario--}}
    <div class="p-3 my-2 col-span-1">
      <div class="grid grid-cols-2 text-3xl p-3">
        <div class="col-span-1 text-left">
          <h1>Temario</h1>
        </div>
          <div class="col-span-1">
            <div class="flex justify-end text-sm">
              <button class="flex items-center hover:text-gray-600 focus:outline-none">
                <div class="p-1">
                  <i class="fas fa-file-download"></i>
                </div>
                <div class="p-1">
                  <h1>Descargar temario</h1>
                </div>
              </button>
            </div>
          </div>
      </div>
      <div class="p-1" x-data="{open:false}">
        <div class="flex p-2 text-xl bg-blueGray-200">
          <button x-on:click="open=!open" class="flex focus:outline-none hover:text-gray-600">
            <div>
              <i class="fas fa-angle-down"></i>
            </div>
            <div class=" mx-2">
              <h1 class="font-semibold">Unidad 1:</h1>
            </div>
            <div>
              <h1>Introducción a Illustrator</h1>
            </div>
          </button>
        </div>
        <div class="p-2 bg-white" x-show="open" x-transition>
          <ul>
            <li>◦Trabajo práctico 1</li>
            <li>◦Video</li>
            <li>◦Teoría</li>
          </ul>  
        </div>
      </div>
    </div>

    {{--descipcion gral. de cursos--}}

    <div class="px-3 col-span-1">
      <div class="flex items-center">
        <div class="p-1">
          <i class="far fa-clock "></i>
        </div>
        <div class="p-1">
          <h1 class="font-semibold"> Duración del curso:</h1>
        </div>
        <div class="">
         <h1>Con 2 horas semanales, lo terminas en 3 meses.</h1> 
        </div>
      </div>
    </div>
    <div class="px-3">
      <div class="flex items-center">
        <div class="p-1">
          <i class="fas fa-infinity"></i>
        </div>
        <div class="p-1">
          <h1 class="font-semibold"> Habilitación de la plataforma:</h1>
        </div>
        <div class="">
         <h1>Para toda la vida!</h1> 
        </div>
      </div>
    </div>
    <div class="px-3">
      <div class="flex items-center">
        <div class="p-1">
          <i class="fas fa-chalkboard-teacher"></i>
        </div>
        <div class="p-1">
          <h1 class="font-semibold"> Profesores disponibles:</h1>
        </div>
        <div class="">
         <h1>Campus virtual con profesores.</h1> 
        </div>
      </div>
    </div>

    {{--cursos relacionados--}}
    <div class="mt-4">
      <div class="p-3 text-3xl">
        <h1>Cursos relacionados</h1>
      </div>
      <div class="grid grid-cols-3 p-3">
        <div class="col-span-1 bg-white m-2 px-6 py-6 rounded-xl shadow-lg transform hover:scale-105 transition duration-500">
          <div class="relative">
            <img class="w-full rounded-xl" src="https://images.unsplash.com/photo-1541701494587-cb58502866ab?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Colors" />
            <p class="absolute top-0 bg-red-500 text-white font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">Certificación oficial</p>
          </div>
          <h1 class="mt-4 text-gray-800 text-3xl font-bold cursor-pointer">
            Adobe Illustrator desde 0
          </h1>
            <button class="mt-4 text-xl w-full text-white hover:bg-indigo-700 bg-indigo-600 py-1.5 rounded-xl shadow-lg">Añadir</button>
          </div>

          <div class="col-span-1 bg-white m-2 px-6 py-6 rounded-xl shadow-lg transform hover:scale-105 transition duration-500">
            <div class="relative">
              <img class="w-full rounded-xl" src="https://images.unsplash.com/photo-1541701494587-cb58502866ab?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Colors" />
              <p class="absolute top-0 bg-red-500 text-white font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">Certificación oficial</p>
            </div>
            <h1 class="mt-4 text-gray-800 text-3xl font-bold cursor-pointer">Adobe Illustrator desde 0</h1>
              <button class="mt-4 text-xl w-full text-white hover:bg-indigo-700 bg-indigo-600 py-1.5 rounded-xl shadow-lg">Añadir</button>
            </div>

            <div class="col-span-1 bg-white m-2 px-6 py-6 rounded-xl shadow-lg transform hover:scale-105 transition duration-500">
              <div class="relative">
                <img class="w-full rounded-xl" src="https://images.unsplash.com/photo-1541701494587-cb58502866ab?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Colors" />
                <p class="absolute top-0 bg-red-500 text-white font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">Certificación oficial</p>
              </div>
              <h1 class="mt-4 text-gray-800 text-3xl font-bold cursor-pointer">Adobe Illustrator desde 0</h1>    
                <button class="mt-4 text-xl w-full text-white hover:bg-indigo-700 bg-indigo-600 py-1.5 rounded-xl shadow-lg">Añadir</button>
              </div>
        </div>
     </div>

    {{--caja datos--}}
    <div class="p-6 col-span-1 ">
      <div class="flex items-center justify-center h-screen">
        <div class="bg-gradient-to-tr from-blue-300 to-indigo-400 flex flex-col w-full border border-gray-900 rounded-xl px-8 py-5 shadow-md">
        <div class="text-white">
          <h1 class="font-bold text-4xl">Dejanos tus datos</h1>
          <p class="font-semibold">Un asesor se contactará para despejar tus dudas!</p>
        </div>
        <form class="flex flex-col space-y-8 mt-10">
          <div class="py-2">
            <input type="text" value="Nombre completo" class="w-full border-b-2 text-blue-100 bg-blueGray-300 bg-opacity-0 text-lg focus:outline-none focus:border-transparent focus:border-white focus:text-white">
          </div>
          <div class="py-2">
            <input type="text" value="Teléfono" class="w-full border-b-2 text-blue-100 bg-blueGray-300 bg-opacity-0 text-lg focus:outline-none focus:border-transparent focus:border-white focus:text-white">
          </div>
          <div class="py-2">
            <input type="text" value="Email" class="w-full border-b-2 text-blue-100 bg-blueGray-300 bg-opacity-0 text-lg focus:outline-none focus:border-transparent focus:border-white focus:text-white">
          </div>
           <select name="Horario" class="w-full border-b-2 text-blue-100 bg-blueGray-300 bg-opacity-0 text-lg focus:outline-none focus:border-transparent focus:border-white focus:text-white">
            <option value="10:00hs_a_12:00hs" class="text-blueGray-600 focus:text-white">10:00hs a 12:00hs</option>
            <option value="12:00hs_a_14:00hs" class="text-blueGray-600 focus:text-white">12:00hs a 14:00hs</option>
            <option value="14:00hs_a_16:00hs" class="text-blueGray-600 focus:text-white">14:00hs a 16:00hs</option>
            <option value="16:00hs_a_18:00hs" class="text-blueGray-600 focus:text-white">16:00hs a 18:00hs</option>
          </select>
          <button class="border border-blue-500 bg-blue-500 text-white rounded-lg py-3 font-semibold focus:outline-none">Cargar</button>
        </form>
      </div>
      </div>
    </div>

  </div>  
    

  {{--pago--}}
  <div class="col-span-1">
    <div class="bg-white rounded-xl p-3 mx-3 my-2 shadow fixed">
      <div class="">
        <img class="rounded-t-xl" src="{{ asset('img/show-courses/illustrator.jpg') }}" alt="">
      </div>
      <div>
        <h1 class="text-2xl p-2 text-center font-semibold">Accedé ahora mismo</h1>
      </div>
      <div class="p-2">
        <h1>Adobe illustrator desde 0</h1>
        <h1 class="text-2xl font-semibold text-red-700">$4.200 ARS</h1>
        <h1>Pago único</h1>
      </div>
      <div class="grid grid-cols-2">
        <div class="col-span-1 text-center p-2">
          <button class="bg-indigo-600 text-white rounded-xl w-full p-2 text-xl transform hover:scale-105 transition duration-500">
            Agregar
          </button>
        </div>
        <div class="col-span-1 text-center p-2">
          <button class="bg-indigo-600 text-white rounded-xl w-full p-2 text-xl transform hover:scale-105 transition duration-500">
           Ir al registro
          </button>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection