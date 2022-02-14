@php
    $cupones = \App\Cupon::where([['habilitado',1],['vendedor',null]])->get();
    $cuponesVendedor = \App\Cupon::where([['habilitado',1],['vendedor',Auth::user()->id]])->get();
@endphp

<div>

  @foreach ($cuponesVendedor as $cupon)
  <div class="input-group">
    <div class="input-group-prepend">
      <div class="input-group-text bg-dark text-white">
        <input type="radio" name="cupon" value={{$cupon->url}} >
        <h3 class="ml-3 mt-1">{{$cupon->name}} |</h3>
        <h3 class="ml-3 mt-1">$ {{$cupon->monto}}</h3>
      </div>
    </div>
  </div>
  @endforeach

@foreach ($cupones as $cupon)
  <div class="input-group">
    <div class="input-group-prepend">
      <div class="input-group-text bg-dark text-white">
        <input type="radio" name="cupon" value={{$cupon->url}} >
        <h3 class="ml-3 mt-1">{{$cupon->name}} |</h3>
        <h3 class="ml-3 mt-1">$ {{$cupon->monto}}</h3>
      </div>
    </div>
  </div>
@endforeach
    
</div>