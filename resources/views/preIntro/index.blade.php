@extends('layouts.app-alt')

@section('content')
    <div style="height:100vh;" class="flex items-center justify-center h-full w-full bg-gradient-to-tr from-white to-blue-400 ">
        <div>
            <div>

                <div class="mb-5  flex justify-center">
                    <img class="w-10/12 md:w-4/12 " src="{{ asset('img/inicio/logo-wn.png') }}" alt="">
                    
                </div>
                <div class="flex justify-center">
                    <ul class="fuente-montserrat ">
                        <li ><a class="flex mb-3 no-underline text-blue-900" href="{{ route('intro', ['country'=>'CL']) }}"><i class="fas fa-chevron-right fa-2x mr-2"></i><img class="w-10 mr-2" src="{{ asset('img/flags/cl.png') }}" alt="Argentina"><span class="text-2xl">CL</span></a></li>
                        <li ><a class="flex mb-3 no-underline text-blue-900" href="{{ route('intro', ['country'=>'AR']) }}"><i class="fas fa-chevron-right fa-2x mr-2"></i><img class="w-10 mr-2" src="{{ asset('img/flags/arg.gif') }}" alt="Argentina"><span class=" text-2xl">AR</span></a></li>
                        <li ><a class="flex mb-3 no-underline text-blue-900" href="{{ route('intro', ['country'=>'UY']) }}"><i class="fas fa-chevron-right fa-2x mr-2"></i><img class="w-10 mr-2" src="{{ asset('img/flags/uy.png') }}" alt="Argentina"><span class="text-2xl">UY</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection