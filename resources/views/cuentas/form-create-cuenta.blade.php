@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="card">
                <form action={{ route('Cuenta.store') }} method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Denominacion</label>
                        <input type="text" class="form-control" name="denominacion" placeholder="Nombre de la cuenta...">
                    </div>
                    <input type="submit" value="Cargar">
                </form>
            </div>
        </div>
    </div>
@endsection