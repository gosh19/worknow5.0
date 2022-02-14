@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Informacion de facturacion
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">

                    <form action={{ route('Cobranza.modificarInfoFac', ['user_id'=> $user_id]) }} method="POST" >
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-danger text-white font-weight-bolder" id="basic-addon1">$</span>
                            </div>
                            <input type="number" class="form-control" value="{{$info_fac->monto_cuota ?? 1200}}" placeholder="Valor Cuota..." name="valor_cuota">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Cantidad de cuotas</label>
                            <input type="number" class="form-control" name="cant_cuotas" value="{{$info_fac->cant_cuotas ?? 6}}" placeholder="Cantidad de cuotas...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Cantidad de cuotas</label>
                            <input type="text" class="form-control" name="fecha_sig_cobro" value="{{$info_fac->fecha_sig_cobro ?? $fecha_sig_cobro}}" placeholder="Cantidad de cuotas...">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Cargar</button>
                        </div>
                    </form>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-center">

                        <img src={{ asset('img/lupa.jpg') }} width="200px"  alt="">
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
  @endsection