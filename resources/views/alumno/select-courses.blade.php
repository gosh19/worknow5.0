@extends('layouts.app')

@section('content')
    <div class="fixed z-10">
        <div class="absolute top-2 left-0 border-2 border-orange-400 bg-white rounded-full">
            <a class="text-orange-400"  href="{{route('User.show',['id'=>Auth::id()])}}"><i class="fas fa-arrow-circle-left fa-3x"></i></a>
        </div>
    </div>
    <div>
        @foreach ($categorias as $cat)
            <div class="mx-3 mb-7">
                <h2 class="text-5xl font-bold text-orange-700">
                    {{$cat->name}}
                </h2>
                <hr class="border-4 border-orange-600 mb-3">
                <div class="grid grid-flow-row grid-cols-1 md:grid-cols-3 gap-20">
                    @foreach ($cat->courses as $course)
                        @php
                            $control = true;
                            foreach (Auth::user()->courses as $cur){
                                if ($cur->id == $course->id){
                                    $control = false;
                                    break;
                                }
                            }
                        @endphp
                        @if ($control)
                            
                        @livewire('inscripcion.curso', ['curso' => $course,'country'=>$country], key($key))
                        @endif            
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection