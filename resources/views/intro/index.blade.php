@extends('layouts.app-alt')

@section('content')

<div class="relative bg-black overflow-hidden">
  <div class="max-w-screen-xl mx-auto">
    <div class="relative z-10 pb-8 bg-black sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-1/2 lg:pb-28 xl:pb-32">
      <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon points="50,0 75,0 50,100 25,100" />
      </svg>

      <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
        <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start">
          <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
            <div class="flex items-center justify-between w-full md:w-auto">
              <a href="#" aria-label="Home">
                  <a class="fuente-bauhaus93 text-white text-3xl mr-auto" href="/">Work Now</a>
              </a>
            </div>
                  
          </div>
          <div class="ml-auto text-white">
              <i class="fas fa-graduation-cap fa-2x"></i>
          </div>
        </nav>
      </div>
      
      <main class="mt-10 mx-auto max-w-screen-xl px-4 sm:mt-12 sm:px-6 md:mt-16  lg:mt-20 lg:px-8 xl:mt-28">
        <div class="sm:text-center lg:text-left">
          <h2 class="text-5xl mb-5 fuente-bauhaus93 tracking-tight leading-10 text-white md:text-center lg:text-left sm:text-left sm:leading-none md:text-6xl">
            Aprender
            <br class="xl:hidden">
            <span class="text-red-700 fuente-bauhaus93">para emprender</span>
          </h2>
          <form method="POST" action="/login">
              @csrf
              <div class="grid grid-cols-1 gap-4 w-full sm:w-auto md:w-full lg:w-3/4 lg:ml-0 md:ml-auto md:mr-auto">
                  <div>
                      <input name="email" type="email" class="bg-white appearance-none border-2 border-red-600 rounded w-full py-3 px-4 text-black leading-tight focus:outline-none focus:bg-orange-300 focus:border-red-600" placeholder="E-mail" id="inline-full-name" type="text">
                      @if ($errors->has('email'))
                      <div class="mt-2 py-1 px-3 bg-red-700 tracking-wider text-white rounded" role="alert">
                          <strong>Correo o contraseña incorrecta</strong>
                      </div>
                      @endif
                  </div>
                  <div>
                      <input name="password" type="password" class="bg-white appearance-none border-2 border-red-600 rounded w-full py-3 px-4 text-black leading-tight focus:outline-none focus:bg-orange-300 focus:border-red-600" placeholder="*********" id="inline-full-name" type="password">
                      @if ($errors->has('password'))
                        <div class="mt-2 py-1 px-3 bg-red-700 tracking-wider text-white rounded" role="alert">
                          <strong>Contraseña incorrecta</strong>
                        </div>
                      @endif
                  </div>
                  <div>
                      <input class="appearance-none transition duration-500 text-white bg-black border-white border-2 w-full py-3 rounded font-bold hover:bg-gray-800 hover:text-black" type="submit" value="INGRESAR">
                  </div>
              </div>
          </form>
          <hr class="border-2 border-white  mt-3 md:w-full lg:w-3/4">
          <a  href={{route('inscripcionTemprana')}}>
              <div class="mt-3 md:w-full lg:w-3/4 bg-red-800 text-center transition duration-500 text-white  border-white border-2 py-3 rounded font-bold hover:bg-gray-800 hover:text-black" >
                      REGISTRATE GRATIS
                  
              </div>
          </a>
          <div class="mt-5 flex justify-around md:w-full lg:w-3/4 text-3xl text-white">
              <a href="https://www.facebook.com/WorkNowarg/"><i class="fab fa-facebook-square"></i></a>
              <a href="https://www.instagram.com/worknowarg/"><i class="fab fa-instagram"></i></a>
              <a href="https://api.whatsapp.com/send?phone=+5492236772444&text=Quiero%20mas%20informacion"><i class="fab fa-whatsapp"></i></a>
              <a href="https://www.youtube.com/channel/UCFcR9BQVm5UeJYjVflshvHQ"><i class="fab fa-youtube"></i></a>
          </div>
        </div>
      </main>
    </div>
  </div>
  <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2" >
    {{--<img class="h-full w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="{{ asset('img/work6.jpg') }}" alt="">--}}
    <div class="h-full w-full object-cover sm:h-72 md:h-0 lg:w-full lg:h-full"
    style="
          background: url({{ asset('img/work6.jpg') }});
          background-size: cover;
          
          background-position-x: right;
          background-position-y: center;
          background-repeat: no-repeat;
          "
    
    >

    </div>
  </div>
</div>
<hr class="border-4 border-red-600">
<div class="bg-gray-100 p-3">
  <h1 class=" text-5xl font-bold text-red-900">Nuestras capacitaciones</h1>
  <hr class="border-2 border-red-800 mb-3">
  <p class="text-md text-gray-500 mb-3">Elegi un maximo de <strong class="text-lg text-red-600">3</strong> cursos para probar y luego registrate <strong class="text-lg text-red-600"><a href="{{route('inscripcionTemprana')}}">Presionando aqui</a></strong> </p>
  
  @foreach ($categorias as $cat)
    <div class="mx-3 mb-7">
      <h2 class="text-5xl font-bold text-orange-700">
        {{$cat->name}}
      </h2>
      <hr class="border-4 border-orange-600 mb-3">
      <div class="grid grid-flow-row grid-cols-1 md:grid-cols-3 gap-20">
        @foreach ($cat->courses as $curso)
        @livewire('inscripcion.curso',['curso'=> $curso,'country'=> $country] , key($curso->id))
      
        @endforeach
      </div>
    </div>
  @endforeach
  
</div>

@endsection
