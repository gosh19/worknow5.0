@extends('layouts.app')

@php
    $cuponObj = json_decode($cupon);
@endphp
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header bg-dark text-white">
            Modifique los datos deseados
        </div>
        <div class="card-body">
            
            <form method="POST" action={{route('Cupon.ModificarCupon')}}>

                @csrf
                <input type="hidden" name="id" value={{$cuponObj->id}} />
                <div class="form-group">
                    <label for="exampleInputEmail1"><strong>Nombre cupon</strong></label>
                    <input type="text" name="name" value={{$cuponObj->name}} class="form-control" aria-describedby="nombre" placeholder="Ingrese Nombre..." required>
                    
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"><strong>Monto</strong></label>
                    <input type="number" name="monto" value={{$cuponObj->monto}} class="form-control" aria-describedby="nombre" placeholder="Ingrese Monto...$" required>
                    
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"><strong>Url cupon</strong></label>
                    <input type="text" name="url" value={{$cuponObj->url}} class="form-control" aria-describedby="nombre" placeholder="Ingrese Url..." required>
                    
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Vendedoras</label>
                    </div>
                    <select name="vendedor" class="custom-select" id="inputGroupSelect01">
                      <option selected value="{{$cupon->vendedor}}">
                        {{$cupon->vendedor == null ? 'Selecciona una vendedora...':$cupon->vendedora->name}}
                    </option>
                      @foreach ($vendedoras as $ven)                       
                      <option value="{{$ven->id}}">{{$ven->name}}</option>
                      @endforeach
                    </select>
                  </div>

                <button type="submit" class="btn btn-primary mt-3">Enviar</button>

            </form>

            <a class="btn btn-danger mt-3" href="/eliminar-cupon/{{$cuponObj->id}}">Eliminar</a>
        </div>
    </div>
</div>

@if (session('msg'))

    <script>
        var title = "Great!";
        var estado = "success";
        var msg = "{{session('msg')}}";
        swal(title, msg, estado );
    </script>
    
@endif

@endsection
