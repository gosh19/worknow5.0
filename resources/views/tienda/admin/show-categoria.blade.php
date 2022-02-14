@extends('layouts.app')

@section('content')
<div class="p-3 ">
    <a href="{{route('Tienda.admin')}}" class=""><i class="fas fa-arrow-circle-left fa-2x"></i></a>
    <div>
        <div class="flex justify-between">

            <h1 class="text-3xl">
                {{$categoria->name}}
            </h1>
            <div>
                <p class="text-xl">Orden</p>
                <form class="flex" action="{{route('Categoria.setOrder',['categoria'=>$categoria])}}" method="POST">
                    @csrf
                    <input type="number" value="{{$categoria->order}}" name="order" class="w-12 border-red-900 border-2 p-1 rounded mr-2">
                    <input type="submit" class="p-2 bg-orange-500 font-bold text-white rounded hover:bg-orange-800" value="Cargar">
                </form>
            </div>
        </div>
    </div>
    <hr class="m-3">
    <div class="grid grid-cols-6 gap-2">
        @foreach ($categoria->courses as $course)
        <div class="border p-2">
            <p class="mb-4">{{$course->nombre}}</p>
            <a class="bg-red-600 font-bold text-white p-2 rounded" 
                href="{{route('Categoria.deleteCatCourse',['categoria'=>$categoria,'course'=>$course->id])}}"
                >ELIMINAR</a>
        </div>
        @endforeach
    </div>
</div>
@endsection