@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-dark text-white">
            Ingrese mail y curso
        </div>
        <div class="card-body">

            <form method="POST" action={{route('envioMail')}}>
                @csrf
                <input type="hidden" name="case" value={{$case}}>
                <div class="form-group">
                    <label for="exampleInputEmail1"><strong>Nombre</strong></label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}" aria-describedby="nombre" placeholder="Ingrese Nombre..." required>
                    
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"><strong>Email</strong></label>
                    <input type="email" name="email" class="form-control" value="{{old('email')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese Correo..." required>
                </div>
                    
                <div class="row">
                    <div class="col-md-6">
                        @if ($errors->has('course_id'))
                            <div class="alert alert-danger">
                                <p>Debe seleccionar un curso al menos</p>
                            </div>
                        @endif
                        @switch($case)
                            @case('informativo')
                                @include('layouts.radioCursos2')

                                @break
                            @case('cupon')
                                
                                @include('layouts.radioCursos2')

                                @break
                            @default
                                
                        @endswitch
                    </div>
                    @if ($case == 'informativo')
                        <div class="col-6">

                            
                            @include('layouts.countryRadio')
                        </div>
                    @else
                    @include('cupones.lista-cupones')
                    @endif
                </div>
                

                <button type="submit" class="btn btn-primary mt-3">Enviar</button>
            </form>
        </div>
    </div>
</div>
@endsection