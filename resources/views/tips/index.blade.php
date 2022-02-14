@extends('layouts.app')

@section('content')
    
<div class="row">
    <div class="col-6 m-3">
        <div class="card p-4 bg-info">

            <form action="{{route ('Tip.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlTextarea1"><h2 class="font-weight-bolder">Escribe el tip y selecciona el curso</h2></label>
                    <textarea class="form-control" placeholder="Tip..." name="texto" id="exampleFormControlTextarea1" rows="3"></textarea>
                    <small class="d-flex justify-content-end"><strong>Nota:</strong>&nbsp; selecciona un solo curso</small>
                </div>
                
                @include('layouts.checkboxCursos')
                <input type="submit" value="Cargar Tip" class="btn btn-primary">
            </form>
        </div>
    </div>
    <div class="col">
        <table class="table">
            <thead>
                <tr>

                    <th>Texto</th>
                    <th>Curso</th>
                    <th>---</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tips as $tip)
                    <tr>
                        <td>{{$tip->texto}} </td>
                        <td>{{$tip->curso->nombre}} </td>
                        <td>

                            @if ($tip->visible)
                            <a href={{ route('Tip.visible', ['id'=>$tip->id]) }} class="btn btn-danger" >Quitar</a> 
                            @else
                            <a href={{ route('Tip.visible', ['id'=>$tip->id]) }} class="btn btn-success" >Agregar</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
    
@if (session('success'))
    
<script>
    swal('Alv', 'se ha cargado tio', 'success')
</script>
@endif

@endsection