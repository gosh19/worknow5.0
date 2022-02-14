@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <div class="border p-2 mb-3">
                    <p>Crear nueva categoria</p>
                    <hr>
                    <form action="{{route('Categoria.store')}}" method="post">
                        @csrf
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Nombre</span>
                            </div>
                            <input type="text" name="name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            @if ($errors->has('name'))
                                
                                <small class="text-danger">Debe ingresar un nombre para cargar</small>
                            @endif
                        </div>
                        <input type="submit" class="btn btn-primary btn-block" value="Cargar">
                    </form>
                </div>
                    <h4>Categorias</h4>
                    <ul class="list-group mt-3">

                        @foreach ($categorias as $categoria)
                            <li class="list-group-item">
                                <div class=" md:flex justify-between">

                                    <a href="{{route('Categoria.show',['Categorium'=>$categoria])}}">{{$categoria->name}}</a>
                                    <a href="{{route('Categoria.delete',['categoria'=> $categoria])}}" class="bg-red-600 font-bold text-white p-2 rounded" >ELIMINAR <i class="fas fa-skull-crossbones"></i></a>
                                    <div class="w-1/3">
                                        <form class="flex" action="{{route('Categoria.setOrder',['categoria'=>$categoria])}}" method="POST">
                                            @csrf
                                            <input type="number" value="{{$categoria->order}}" name="order" class="w-10 border-red-900 border-2 p-1 rounded mr-2">
                                            <input type="submit" class="p-2 bg-orange-500 font-bold text-white rounded hover:bg-orange-800" value="Cargar">
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
            </div>
            <div class="col-span-4">
                @include('tienda.admin.set-course-cat',['courses'=> $courses, 'categorias'=> $categorias])
            </div>
        </div>
    </div>
@endsection