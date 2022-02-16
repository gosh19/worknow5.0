@extends('layouts.app-alt')

@section('content')
    
<div class="bg-gray-900 pb-5 relative max-w-full">
    
    <div class="relative pt-6 px-4  lg:px-8 mb-4">
      <nav class="relative flex items-center justify-between sm:h-10 ">
        <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
          <div class="flex items-center justify-between w-full md:w-auto">
            <a href="#" aria-label="Home">
                <a class="fuente-bauhaus93 text-white text-3xl mr-auto" href="/">Work Now</a>
            </a>
          </div>            
        </div>
      </nav>
    </div>
    <div class="border-2 border-white md:w-3/4 p-3 m-3">

      <div class="grid grid-flow-row grid-cols-1 md:grid-cols-3 mb-3">
        <div class="col-span-2">
          <h1 class="text-5xl text-left text-white font-bold mb-3">{{$course->nombre}}</h1>

          <hr class="mb-3 border border-gray-500">
          <div class="flex">
            <i class="fas fa-tags fa-3x text-red-800 mr-3"></i>
            <p class="text-gray-300 text-left mb-3 text-xl">
              La duracion del curso depende del tiempo que le dediques y los conocimientos previos 
              con los que accedas. El 90% de 
              los alumnos que se inscriben a esta cursada suelen demorar
              aproximadamente entre 3 y 6 meses. Tenga en cuenta que mientras mas tiempo 
              le dedique, menor sera su duracion.
            </p>
          </div>
          
        </div>
        <div class="md:col-span-1 p-3">
          <div class="border-2 border-white rounded-2xl shadow-outline-indigo">
            <img class="w-full rounded-2xl" src="{{$course->url_img}}" alt="">
          </div>
        </div>
      </div>

    </div>

    <div class="md:fixed md:z-10 md:w-1/5 right-0 top-0 mx-3 mt-20 bg-white shadow-2xl border-2 border-gray-500">
      <div class="border-2 border-white p-3">
        @if ($course->info != null)
          @if ($course->info->on && ($course->info->discount != null)&&(!$course->info->free))                               
            <div class="md:absolute right-3 top-3 text-center">
              <p class=" bg-red-800 py-1 px-2 text-white font-extrabold">
                {{$course->info->discount}}% Off
              </p>
            </div>
          @else 
            @if ($course->info->free) 
              <div class="md:absolute right-3 top-3 text-center">
                <p class=" bg-red-800 py-1 px-2 text-white font-extrabold">
                  GRATIS
                </p>
              </div>
            @endif
          @endif
        @endif
        <img src="{{ asset('img/Personaje.png') }}" class="hidden md:block md:w-full" alt="">
        <p class="text-2xl font-bold">Accede ahora mismo</p>
        <small>{{$course->nombre}}</small>
        <div class="mb-2">
          <div>
            @if ($course->info != null)
              @if ($course->info->on && ($course->info->discount != null))
              
              <s class="text-md text-gray-500 font-bold"> $ {{(($country == 'AR')||($country == 'ARG'))?$course->info->peso:($country == 'PY' ?number_format(($course->info->dolar*(session('conversion')?? 7045)),2,',','.'):$course->info->dolar)}} {{(($country == 'AR')||($country == 'ARG'))? 'ARS':($country == 'PY' ?'PYG':'USD')}}</s>
              @endif
            @endif
            <p class="text-xl text-white-700 ">
              <strong>
                $
                @if ($course->info != null)
                {{number_format($course->info->getPrecio($country),2,',','.')}}
                @else
                {{(($country == 'AR')||($country == 'ARG'))? 1989:($country == 'PY' ?number_format((23*(session('conversion')?? 7045)),2,',','.'):23)}}
                @endif
                {{(($country == 'AR')||($country == 'ARG'))? 'ARS':($country == 'PY' ?'PYG':'USD')}}
              </strong>
            </p>
            <p>Pago <strong>Unico</strong></p>
          </div>
        </div>
        <hr class="mb-2">
        <div class="flex justify-around text-xl mb-2">
          <i class="fab fa-cc-visa text-blue-600"></i>
          <i class="fab fa-cc-paypal text-indigo-800"></i>
          <i class="fab fa-cc-mastercard text-pink-700"></i>
          <i class="fab fa-cc-amex text-red-600"></i>
        </div>
        <hr class="mb-2">
        <div class="flex justify-center mb-3">
          @if ($canSelect)
          <a class="py-2 rounded text-decoration-none text-center w-full bg-blue-700 transition-all duration-300 hover:bg-blue-500 text-white font-bold" 
                href="{{route('addCourse',['Course'=> $course])}}"
            >
              Agregar
            </a>
          @else
            <p class="py-2 rounded text-decoration-none text-center w-full bg-blue-300 text-black font-bold">
              Agregado
            </p>
          @endif
            
        </div>
        <div class="flex justify-center">
          <a class="py-2 rounded text-decoration-none text-center w-full bg-red-700 transition-all duration-300 hover:bg-red-500 text-white font-bold" 
                href="{{route('inscripcionTemprana')}}"
            >
              Ir al registro
            </a>   
        </div>
      </div>  
    </div>
    
</div>
<hr class="w-full border-4 border-red-700">

<div class="mx-3 my-5 ">
  <div class="border-2 border-gray-300 md:w-3/4 p-3 shadow-lg">
    <div class="flex justify-between">

      <h1 class="text-3xl font-bold text-gray-700">Unidades</h1>
      <a target="_blanck" class="text-center text-gray-700" href="{{$course->url_temario}}">
        <p class="font-bold text-center">
          <i class="far fa-file-alt fa-2x"></i><br>
          Temario</p>
      </a>
    </div>
    <hr class="my-2">
    <ul class="p-2">
      @foreach ($course->unities as $unity)
          <li class="text-lg font-bold text-gray-500 mb-3">
            <i class="fas fa-check mr-3 text-red-700"></i>{{$unity->nombre}} <a class="cursor-pointer" data-toggle="collapse" data-target="#collapse-{{$unity->id}}"><i class="fas fa-caret-down"></i></a>
            <ul class="ml-4 collapse" id="collapse-{{$unity->id}}">
              @foreach ($unity->modules as $module)
              <li>

                <i class="fas fa-angle-right mr-3 text-red-800"></i>{{$module->titulo}}
              </li>
              @endforeach
            </ul>
          </li>
      @endforeach
        <li class="text-lg font-bold text-gray-500 mb-2">
          <a target="_blanck" href="{{$course->url_temario}}">

            <i class="fas fa-angle-double-right mr-3 text-red-700"></i>
            Ver mas...
          </a>
        </li>
    </ul>
  </div>
</div>

@if ($course->videoMuestra != null)
  @if ($course->videoMuestra->url != null)
      
    <div class="mx-3 my-5" >
      <div class="border-2 border-gray-300 md:w-3/4 p-3 shadow-lg">
        <h1 class="text-3xl font-bold text-gray-700"><i class="fab fa-youtube text-red-900 mr-4"></i> Video de muestra</h1>
        <hr class="my-3">
        <div class="flex">
          <div class="text-xl text-gray-500 w-full border">
            <iframe width="100%" height="500" src="{{$course->videoMuestra->url}}" frameborder="0"  allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
  @endif
@endif


<div class="mx-3 my-5" >
  <div class="border-2 border-gray-300 md:w-3/4 p-3 shadow-lg">
    <h1 class="text-3xl font-bold text-gray-700">Descripcion</h1>
    <hr class="my-3">
    <div class="flex w-full">
      <i class="fas fa-info-circle text-red-900 fa-3x mr-4"></i>

      <div class="text-xl text-gray-500 w-9/12 md:w-full overflow-ellipsis overflow-hidden">
        {!! $course->descripcion !!}
      </div>
    </div>
  </div>
</div>
<hr class="my-3 mx-3 md:w-3/4">

<div class="border-2 border-gray-300 md:w-3/4 p-3 shadow-lg mx-3">
  <p class="font-bold text-xl text-center text-red-600 mb-3">Deja tus datos para que se contacte un asesor para despejar tus dudas <br> sobre el curso de {{$course->nombre}} </p>
  <form class="flex justify-center" action="{{route('Tienda.contacto',['course'=> $course])}}" method="post">
    @csrf
    @if (session('platform'))
        <input type="hidden" name="platform" value="{{session('platform')}}">
    @endif
    <div class="grid grid-rows-1 gap-5 p-4 border-2 text-black border-red-300 rounded w-full md:w-1/2">
      <div class="mb-3 relative h-5">
        <div class=" w-full absolute z-50">
          <input type="text" name="name" required placeholder="Nombre" class="h-10 px-3 text-xl font-bold placeholder-black w-full bg-white focus:bg-white-500">
        </div>
        <div class="h-10 bg-red-600 w-full absolute top-2 right-2 z-40"></div>
      </div>
      <div class="mb-3 relative h-5">
        <div class=" w-full absolute z-50">
          <input type="number" name="phone" required placeholder="Telefono" class="h-10 px-3 text-xl font-bold placeholder-black w-full bg-white-400 focus:bg-white-500">
        </div>
        <div class="h-10 bg-red-600 w-full absolute top-2 right-2 z-40"></div>
      </div>
      <div class="mb-3 relative h-5">
        <div class=" w-full absolute z-50">
          <input type="text" name="email" placeholder="E-mail" class="h-10 px-3 text-xl font-bold placeholder-black w-full bg-white-400 focus:bg-white-500">
        </div>
        <div class="h-10 bg-red-600 w-full absolute top-2 right-2 z-40"></div>
      </div>
      <div class="relative h-5">
        <div class="h-10 bg-red-600 w-full absolute top-3 right-2 z-40"></div>
        <div class=" w-full absolute z-50">

          <select name="horario" class="bg-white-400 focus:bg-white-500 text-lg w-full p-2 text-black font-bold">
            <option value="10:00hs_a_12:00hs">10:00hs_a_12:00hs</option>
            <option value="12:00hs_a_14:00hs">12:00hs_a_14:00hs</option>
            <option value="14:00hs_a_16:00hs">14:00hs_a_16:00hs</option>
            <option value="16:00hs_a_18:00hs">16:00hs_a_18:00hs</option>
          </select>
        </div>
      </div>
      <hr class="my-2">
      <input class="w-full py-2 bg-red-600 text-xl font-bold rounded" type="submit" value="Cargar">
    </div>
  </form>
</div>

<hr class="my-3 mx-3 md:w-3/4">
<div class="my-4 mx-3">
  <a class="py-2 px-5 bg-white-500 font-bold rounded text-white tracking-wider" href="{{route('inscripcionTemprana')}}">
    <i class="fas fa-backward"></i> Volver al registro
  </a>
</div>
<hr class="w-full border-4 border-red-700">
<div class="bg-gray-500 p-3 pb-5">
  <h1 class="text-5xl text-center font-bold text-white mb-3">¡Los cursos mas elegidos!</h1>
  <div class="grid grid-flow-row md:grid-cols-4">
    @foreach ($list as $item)
      <div class="mx-3 mb-3 p-2 py-auto bg-gray-100 rounded border-2 border-red-400">
        <div class="flex h-full">
            <i class="flex self-center fas fa-tag fa-2x mr-2 text-red-600"></i>
            <h1 class="flex self-center text-2xl font-bold mb-2 ">
              <a class="hover:no-underline hover:text-white-600 transition-all duration-200" href="{{route('Intro.ShowCourse',['Course'=> $item])}}">
                {{$item->nombre}}
              </a>
            </h1>
        </div>
      </div>
    @endforeach
  </div>
</div>
<hr class="w-full border-4 border-red-700">
<div class="bg-black p-3 pb-5">
  <div class="flex justify-around w-full text-3xl text-white">
    <a href="https://www.facebook.com/WorkNowcursos/"><i class="fab fa-facebook-square"></i></a>
    <a href="https://www.instagram.com/worknowcursos/"><i class="fab fa-instagram"></i></a>
    <a href="https://api.whatsapp.com/send?phone=+5492236772444&text=Quiero%20mas%20informacion"><i class="fab fa-whatsapp"></i></a>
    <a href="https://www.youtube.com/channel/UCFcR9BQVm5UeJYjVflshvHQ"><i class="fab fa-youtube"></i></a>
  </div>
</div>
@endsection