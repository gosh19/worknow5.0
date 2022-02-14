@extends('layouts.app')


@section('content')

<div class="container">
    <div class="card">
        <div class="card-header bg-dark text-white">
            Ingrese los datos del cupon
        </div>
        <div class="card-body">
            
            <form method="POST" action={{route('Cupon.store')}}>
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1"><strong>Nombre cupon</strong></label>
                    <input type="text" name="name" class="form-control" aria-describedby="nombre" placeholder="Ingrese Nombre..." required>
                    
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"><strong>Monto</strong></label>
                    <input type="number" name="monto" class="form-control" aria-describedby="nombre" placeholder="Ingrese Monto...$" required>
                    
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"><strong>Url cupon</strong></label>
                    <input type="text" name="url" class="form-control" aria-describedby="nombre" placeholder="Ingrese Url..." required>
                    
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-primary text-white" for="inputGroupSelect01">Vendedoras</label>
                    </div>
                    <select name="vendedor" class="custom-select" id="inputGroupSelect01">
                      <option selected value={{null}} >Selecciona una vendedora...</option>
                      @foreach ($vendedoras as $ven)                       
                      <option value="{{$ven->id}}">{{$ven->name}}</option>
                      @endforeach
                    </select>
                </div>
                <small>En caso de no seleccionar vendedora el cupon queda para todas</small>
                <button type="submit" class="btn btn-primary mt-3">Enviar</button>
            </form>
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