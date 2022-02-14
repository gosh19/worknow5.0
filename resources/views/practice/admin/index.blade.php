@extends('layouts.app')

@section('content')
@if (session()->has('msj'))
    <div class="alert alert-success text-center">
        <p>{{session('msj')}}</p>
    </div>
@endif
    <div class="container-fluid">
        <div class="row">
            <div class="alert alert-info w-100">
                <h1>Seccion de practicas</h1>
                <p>Aqui podras ver todas las practicas creadas, ademas de poder crear nuevas.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-left">
                    <div class="card-header bg-primary text-white">
                        Practicas existentes
                    </div>
                  <ul class="list-group">
                    @foreach ($practices as $practice)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <p>{{$practice->titulo}}</p>
                                <p>{{$practice->course->nombre}}</p>
                                <a class="btn btn-danger" href="{{route('Practice.edit',['Practice'=> $practice])}}">Editar</a>
                            </div>
                            
                        </li>
                    @endforeach
                </ul>
                </div>
                
            </div>
            <div class="col-md-8">
                <div class="card text-left">
                  <div class="card-header">
                      Crear nueva practica
                  </div>
                  <div class="card-body">
                    <form action="{{route('Practice.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                          <label for="title">Titulo</label>
                          <input type="text" class="form-control" value="{{old('title')}}" name="title" id="title" placeholder="Titulo...">
                          @if ($errors->has('title'))
                              <small class="text-danger">Error X</small>
                          @endif
                        </div>
                        <div class="form-group">
                          <label for="desc">Descripcion</label>
                          <textarea class="form-control" name="desc" id="desc" rows="4"></textarea>
                          @if ($errors->has('desc'))
                              <small class="text-danger">Error X</small>
                          @endif
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    @if ($errors->has('course_id'))
                                        <div class="alert alert-danger">
                                            Debe seleccionar un curso
                                        </div>
                                    @endif
                                    @include('layouts.radioCursos2')
                                </div>
                                <div class="col-md-6">
                                    <img class="mb-3" src="{{ asset('img/Escritorio.png') }}" width="100%" alt="">
                                    <input type="submit" class="btn btn-primary btn-block" value="Cargar">
                                </div>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection