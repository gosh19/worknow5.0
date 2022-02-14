@extends('layouts.app')

@section('content')
<div class="grid grid-cols-6 gap-3 m-4">

    @foreach ($vendedoras as $vendedora)
        @if (count($vendedora->ventasAlta) != 0)
            
            <div class="col-span-1 p-2 bg-red-900 border-2 border-red-900 justify-items-center rounded">
                <a class="text-lg text-white" href={{route('Vendedor.perfil',['id'=>$vendedora->id])}}>{{$vendedora->name}}</a>
                <div class="m-2">
                    <ul class="text-white">
                        <li>
                            <p>{{count($vendedora->ventasAlta)}} Venta(s)</p>
                        </li>
                        <li>
                            <strong>$ {{$vendedora->comision}}</strong>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
    @endforeach
</div>
    <div class="container" id="VendedorasView" ><h3>Loading...</h3> </div>

@endsection