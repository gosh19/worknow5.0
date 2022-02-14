<div class="card bg-dark">
    <div class="card-header bg-primary text-white">
      Estado
    </div>
    <div class="card-body">
      @if ($user->habilitado == 0)
          <div class="alert alert-danger" role="alert">
            No puede entrar <span><img src={{ asset('img/warn.png') }} alt=""></span>
          </div>
          <a href="/modificar-hab/{{$user->id}}"><button class="btn btn-success">Habilitar</button></a>
      @else
          <div class="alert alert-success" role="alert">
            Puede entrar <span><img src={{ asset('img/checked.png') }} alt=""></span>
          </div>
          <a href="/modificar-hab/{{$user->id}}"><button class="btn btn-danger">Deshabilitar</button></a>
      @endif

    </div>
    <hr>
    @if ($user->tipo_pago == "efectivo")
    <div class="alert alert-info m-2">
      <h3><strong >Unidades habilitadas actualmente: </strong>{{$user->unities_habilitadas}}</h3>
      <form action={{ route('habilitarUnidad') }} method="POST">
        @csrf
        <input type="hidden" name="id" value={{$user->id}}>
        <input type="number" name="cant" value={{$user->unities_habilitadas}}>
        <input type="submit" class="btn btn-info">
      </form>
    </div>
        
    @endif
  </div>