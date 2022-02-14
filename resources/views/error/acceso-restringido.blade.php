@extends('layouts.app')

@section('content')
<style>
    .imagen{
        width: 100%;
    }
    .caja-restringido{
        padding: 25px;
        border: 3px solid #D8D8D8;
        border-radius: 20px;
        background: linear-gradient(45deg, #C70404, #F17A0C);
        color: white;
    }
    .caja-restringido>h1{
        font-family: 'Verdana';
    }
</style>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img class="imagen" src={{ asset('img/lupa.jpg') }} alt="">
            </div>
            <div class="col-md-6">
                <div class="caja-restringido">
                    <h1>Parece que te haz perdido!</h1>
                    <hr>
                    <p>El contenido al que deseas acceder esta restringido para tu usuario.</p>
                    <p>Para saber mas sobre el tema contactanos por whatsApp o correo electronico!</p>
                    <hr>
                    <div class="d-flex justify-content-center">

                        <a href="/" class="btn  btn-primary">Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection