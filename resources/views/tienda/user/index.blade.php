@extends('layouts.app')

@section('content')
@if (session()->has('error'))
    <div class="alert alert-danger text-center">
        <h1>Error</h1>
        <h4>{{session('error')}}</h4>
    </div>
@endif
    <div class="alert alert-info">
        <h3>Tienda virtual de Work Now</h3>
        <p>Aqui podras encontrar insumos, herramientas y mucho mas para tu capacitacion. 
            Se iran agregando proveedores y materiales todos los dias, en caso de necesitar algo en especifico pediselo a tu 
            profesor a cargo, de esa forma podremos ir actualizando la lsita conforme a las necesidades de los alumnos.
        </p>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div>
                    @if ($carrito != null)
                        <a href="{{route('Tienda.confirmCompra',['Carrito' => $carrito])}}" 
                            onclick="javascript: return confirm('Recuerde que al confirmar quedara a disposicion del instituto para su pago y posterior envio')" 
                            class="btn btn-block btn-success mb-3"
                        >Terminar Compra</a>
                    @endif
                    <button class="btn btn-danger btn-block mb-3" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Ver Carrito
                    </button>
                </div>
                <div class="collapse mb-3" id="collapseExample">
                    <div class="card card-body">
                        @if ($carrito == null)
                            <p>No hay productos en el carrito aun.</p>
                        @else
                        <ul class="list-group">
                            
                            @foreach ($carrito->prodPedidos as $prodPedido)
                            <li class="list-group-item">
                                <p><b>{{$prodPedido->product->name}}</b></p>
                                <p><b>Cant: </b> {{$prodPedido->cant}}</p> 
                                <hr>
                                <div class="d-flex justify-content-around">
                                    <a class="btn btn-success " href="{{route('Carrito.addCant',['ProdPedido' => $prodPedido])}}">+</a>
                                    <a class="btn btn-danger " href="{{route('Carrito.descCant',['ProdPedido' => $prodPedido])}}">-</a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                  </div>
                <h4 class="text-primary">Categorias</h4>
                <ul class="list-group mt-3">
                    @foreach ($categorias as $categoria)
                        <li class="list-group-item"><a href="{{route('Tienda.user',['catSeleccionada'=> $categoria])}}"> {{$categoria->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-10">
                @if ($pendiente != null)
                    <div class="alert alert-success">
                        <h3>Compra pendiente</h3>
                        <p>Actualmente tiene una compra pendiente de confirmacion. debe esperar a que administracion confirme el stock
                            y le envie el cupon de pago para su posterior envio. Ante cualquier duda recuerde que tiene a su disposicion
                            el contacto via WhastApp o por email.
                        </p>
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
                            <hr>
                            <a class="btn btn-danger" onclick="javascript: return confirm('Seguro que desea cancelar la compra? Se eliminaran todos los datos de su carrito de compra')" href="{{route('Carrito.delete',['Carrito' => $pendiente])}}">Cancelar compra</a>
                        </div>

                    </div>
                @endif
                @if ($catSeleccionada != null)
                
                <h1>{{$catSeleccionada->name}}</h1>
                    <div class="row">
                    @foreach ($catSeleccionada->products as $product)
                        @include('tienda.user.producto',['product' => $product])
                    @endforeach
                </div>
                    <hr>
                @endif
                <h1>Ultimos Productos Cargados</h1>
                <div class="row">
                    @foreach ($productos as $product)
                        @include('tienda.user.producto',['product' => $product])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection