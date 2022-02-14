@php
    $listaVendedores = \App\Vendedor::getAll();
@endphp

@if ($user->venta != null)
    <h4>Vendido por <strong>{{$user->venta->datosVendedor['name']}}</strong>
    <a href={{ route('Venta.modificarAlta', ['id'=>$user->id]) }} >
        @if ($user->venta->alta)
            
        <span class="btn btn-danger">Dar Baja Venta</span>
        @else
        <span class="btn btn-success">Dar Alta Venta</span>    
        @endif
    </a>
    </h4>
    <form action="/modificar-estado-venta" method="post">
        @csrf
        <input type="hidden" name="id" value={{$user->venta->id}} >
        <div class="form-group">
          <label class="font-weight-bolder">Puntos extra : </label>
          <input type="number" name="puntos_extra" step="0.5" value={{$user->venta->puntos_extra}}>
        </div>
        <div class="form-group">
            <label class="font-weight-bolder">Comision : </label>
            <input type="number" name="comision"  value={{$user->venta->comision}}>
        </div>
        <div class="form-group">
            <label class="font-weight-bolder">Fecha : </label>
            <input type="date" name="date" value={{$user->venta->fecha}}>
        </div>
        <select name="estado" class="custom-select" id="inputGroupSelect01">
            @if ($user->venta->estado == 'pendiente')
            <option selected value="pendiente">Pendiente</option>
            <option value="cerrada">Cerrada</option>  
            @else
            <option value="pendiente">Pendiente</option>
            <option selected value="cerrada">Cerrada</option>      
            @endif
        </select>
        <input type="submit" class="btn btn-primary mt-1" value="Modificar">
    </form>
    @else
    <div class="container">
        <div class="alert alert-primary">

        <h5>Esta venta no pertenece a ninguna vendedora.</h5>
        <p>Para cargarsela a alguien seleccione su nombre</p>
        </div>
        <div class="row">

        <ul class="list-group">
            <li class="list-group-item">

                <a 
                class="btn btn-danger"
                href={{ route('CargarVendedor', [
                                                'alumno'=>$user->id,
                                                'vendedor' => Auth::user()->id,
                                                ])}} 
                >Admin</a>
            </li>  
        @foreach ($listaVendedores as $item)
            <li class="list-group-item">

                <a 
                class="btn btn-primary"
                href={{ route('CargarVendedor', [
                                                'alumno'=>$user->id,
                                                'vendedor' => $item->id,
                                                ])}} 
                >{{$item->name}}</a>
            </li>  
        @endforeach
        </ul>

        </div>
    </div>
        
@endif