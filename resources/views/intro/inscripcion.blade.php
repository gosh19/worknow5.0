@extends('layouts.app-alt')

@section('content')


<div class="bg-white pb-5">
    
    <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
        <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start">
          <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
            <div class="flex items-center justify-between w-full md:w-auto">
              <a href="#" aria-label="Home">
                  <a class="fuente-bauhaus93 text-red-600 text-3xl mr-auto" href="/">Work Now</a>
              </a>
            </div>
                  
          </div>
          <div class="ml-auto text-black fuente-bauhaus93 text-lg md:text-2xl">
              Datos del alumno&nbsp;<i class="fas fa-graduation-cap fa-2x text-red-700"></i>
          </div>
        </nav>
    </div>
    <div>

      @livewire('inscripcion.form',['country'=>$country])
    </div>


    
</div>
@endsection