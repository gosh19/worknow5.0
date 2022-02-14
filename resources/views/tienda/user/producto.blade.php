<div class="col-md-3">
    <div class="card text-white bg-primary h-100">
        @if (count($product->imgs) == 0)
            <img class="card-img-top" src="{{ asset('img/lupa.jpg') }}" alt=""> 
        @else
        <a data-toggle="modal" data-target="#ModalImg{{$product->id}}">

            <img style="cursor: pointer;" class="card-img-top" src="{{ asset($product->imgs[0]->url) }}" alt="">  
        </a>
        @endif
        <div class="card-body">
            <h4 class="card-title">{{$product->name}}</h4>
            <p class="card-text">{{$product->desc}}</p>
            
        </div>
        <div class="card-footer">
            <h4 class="text-center ">$ {{$product->precio}} </h4>
            <hr>
            <a class="btn btn-success btn-block" href="{{route('Carrito.addProd',['Product'=> $product])}}">Agregar al carrito</a>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalImg{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalImg{{$product->id}}Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalImg{{$product->id}}Label">{{$product->name}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="IndicatorProd{{$product->id}}" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach ($product->imgs as $i => $img)
                        @if ($i == 0)
                            <li data-target="#IndicatorProd{{$product->id}}" data-slide-to="0" class="active"></li>
                        @else
                            <li data-target="#IndicatorProd{{$product->id}}" data-slide-to="{{$i}}"></li>
                        @endif
                    @endforeach
                </ol>
                <div class="carousel-inner border border-primary ">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4">

                            @foreach ($product->imgs as $i => $img)
                                @if ($i == 0)
                                    <div class="carousel-item active">
                                        <img src="{{$img->url}}" style="max-height: 200px;">
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        <img src="{{$img->url}}" style="max-height: 200px;">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="col-4"></div>
                    </div>
                </div>
                <a class="carousel-control-prev bg-dark p-2" href="#IndicatorProd{{$product->id}}" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only bg-dark">Anterior</span>
                </a>
                <a class="carousel-control-next bg-dark p-2" href="#IndicatorProd{{$product->id}}" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Siguiente</span>
                </a>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>