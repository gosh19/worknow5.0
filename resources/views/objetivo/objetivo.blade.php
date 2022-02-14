@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-6">

        
            <div class="card">
                <div class="card-header">
                    Objetivo general del mes
                </div>
                <div class="card-body">
                    <form action={{ route('Objetivo.update') }} method="post">
                        @csrf

                        <input type="hidden" class="form-control" name="id" value={{$objetivoGeneral->id ?? 1}} >

                        <div class="form-group">
                            <label>Referencia</label>
                            <input type="text" class="form-control" name="referencia" value="{{$objetivoGeneral->referencia ?? "Objetivo-General"}}" required>
                        </div>
                        <div class="form-group">
                            <label>Cantidad de Cursos</label>
                            <input type="number" class="form-control" name="cantidad_cursos" value={{$objetivoGeneral->cantidad_cursos ?? ""}} required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="m-3">
        @livewire('objetivo.panel')
    </div>
@endsection