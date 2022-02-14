<div class="row">
    <div class="col-md-6">
        <table class="table table-stripped">
            <thead>
                <th scope="row">#</th>
                <th scope="row">Nombre</th>
                <th scope="row">Precio</th>
                <th scope="row">Puntos</th>
                <th>---</th>
            </thead>
            <tbody>
                @foreach ($kitTypes as $kit)
                <form action="{{route('KitType.update',['KitType'=> $kit])}}" method="post">
                    @csrf
                    @method('PUT')
                    <tr>
                        <td scope="row">{{$kit->id}}</td>
                        <td><input type="text" name="name" value="{{$kit->name}}" id=""></td>
                        <td><input type="text" size="7" name="precio" value="{{$kit->precio}}" id=""></td>
                        <td><input type="text" size="5" name="puntos" value="{{$kit->puntos}}" id=""></td>
                        <td>
                            <div class="row">
                                <input type="submit" class="btn btn-primary" value="Modificar">
                                <a onclick="javascript:return confirm('¿Seguro que desea borrar el Kit?')" class="btn btn-danger" href="{{route('KitType.delete',['KitType'=> $kit])}}">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                </form>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-danger text-white ">
                Cargar nuevo kit
            </div>
            <div class="card-body">
                <form action="{{route('KitType.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="name">Nombre del kit :</label>
                      <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="precio">Precio :</label>
                                <input type="number" class="form-control" name="precio" id="precio" placeholder="$...">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="puntos">Puntos :</label>
                                <input type="text" name="puntos" class="form-control" id="puntos" value="1">
                            </div>
                        </div>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-block btn-warning">Cargar</button>
                </form>
            </div>
        </div>
    </div>
</div>