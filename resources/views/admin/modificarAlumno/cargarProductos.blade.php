@extends('layouts.app') 

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-danger text-white">
                Ingrese los siguientes datos
            </div>
            <div class="card-body">
                <form action="{{route('User.verComprobante',['User'=> $user])}}" method="post">

                    @csrf
                    @for ($i = 0; $i < $cant; $i++)
                        <div class="row">
                            <div class="col-1">
                                <h2 style="color: rgb(197, 80, 13);">{{$i+1}}<i class="far fa-arrow-alt-circle-right"></i></h2>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <input type="text" name="cant[{{$i}}]" class="form-control" placeholder="Cantidad">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <input type="text" name="codigo[{{$i}}]" class="form-control" placeholder="Codigo producto">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <input type="text" name="valor[{{$i}}]" class="form-control" placeholder="Valor producto...$">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <input type="text" name="name[{{$i}}]" class="form-control" placeholder="Nombre producto">
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endfor
                    <div class="row justify-content-end">

                        <input type="submit" value="Continuar" class="btn bg-danger mr-3 text-white">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection