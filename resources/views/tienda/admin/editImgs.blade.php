@extends('layouts.app')

@section('content')
<a href="{{route('Tienda.admin')}}" class="btn btn-danger">Volver</a>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="border p-2">
                    <h3>Seleccione la imagen a cargar</h3>
                    <form action="{{route('Product.loadImg',['Product' => $product])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="img" id="">
                        <input type="submit" value="Cargar" class="btn btn-danger">
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <h2>Imagenes existentes</h2>
                <hr>
                <div class="row">
                    @foreach ($product->imgs as $img)
                        <div class="col-md-4">
                            <img src="{{$img->url}}" width="100%">
                            <a class="btn btn-danger mt-3 btn-block" 
                                onclick="javascript: return confirm('Seguro que desea eliminar la imagen?')" 
                                href="{{route('Product.deleteImg',['Img'=>$img])}}"
                            >Eliminar</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection