@php
    switch ($pendiente->estado) {
        case 'pendiente':
            $title = 'Venta pendiente de aprobacion - enviar cupon y controlar el pago';
            $theme = 'primary';
            break;
        case 'confirmado':
            $title = 'Venta confirmada y lista para enviar';
            $theme = 'success';
            break;
        default:
            # code...
            break;
    }
@endphp


<div class="card text-white bg-{{$theme}}">
  <div class="card-header">
      {{$title ?? 'Error'}}
  </div>
  <div class="card-body">
    <table class="table bg-light">
        <thead>
            <th scope="row">Producto</th>
            <th scope="row">Cantidad</th>
            <th scope="row">Precio por unidad</th>
            <th scope="row">Sub-total</th>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach ($pendiente->prodPedidos as $prodPedido)
            <tr>
                <td>{{$prodPedido->product->name ?? 'Error'}}</td>
                <td>{{$prodPedido->cant}}</td>
                <td>$  {{$prodPedido->product->precio ?? 'Error'}}</td>
                <td>$  {{($prodPedido->product->precio * $prodPedido->cant) ?? 'Error'}}</td>
            </tr>
            @php
                $total += ($prodPedido->product->precio * $prodPedido->cant);
            @endphp
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">

        <h3><b>Total : $ </b>{{$total}}</h3>
    </div>
  </div>
@switch($pendiente->estado)
    @case('pendiente')
        <div class="card-footer text-muted">
            <a href="{{ route('Tienda.confirmCarrito',['Carrito' => $pendiente]) }}" class="btn btn-block btn-danger">Confirmar pedido</a>
        </div>
        @break
    @case('confirmado')
        <div class="m-3 p-3 bg-light text-dark">
            <h5>Datos de envio : </h5>
            <hr>
            <form action="{{route('Tienda.editDatosPedido')}}" method="post">
                @csrf
                <input type="hidden" name="carrito_id" value="{{$pendiente->id}}">
                <div class="form-group">
                    <label for="CS">Codigo Seguimiento</label>
                    <input type="text"
                            class="form-control" name="codigo_seguimiento" id="CS" value="{{$pendiente->datosPedido->codigo_seguimiento ?? ''}}">
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <select class="custom-select" name="estado">
                        @if ($pendiente->datosPedido != null)
                            <option selected value="{{$pendiente->datosPedido->estado}}"><b>{{$pendiente->datosPedido->estado}}</b></option>
                        @endif
                        <option value="pendiente">Pendiente</option>
                        <option value="enviado">Enviado</option>
                        <option value="recibido">Recibido</option>
                        <option value="cancelado">Cancelado - <b>IMPORTANTE: se eliminara la compra</b></option>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="Cargar">
            </form>
        </div>
        @break
    @default
        
@endswitch

</div>