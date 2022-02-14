@php
    $kitTypes = \App\KitType::all();

    $kit = \App\Kit::where('user_id',$user_id)->first();
@endphp
<h5>Coloque si tiene kit:</h5>
<div class="input-group mb-3">
    <div class="input-group-prepend">
    <label class="input-group-text bg-warning" for="inputGroupSelect01">KIT DE HERRAMIENTAS</label>
    </div>
    <select name="kit" class="custom-select" id="inputGroupSelect01">
        @if ($kit != null)
            @if ($kit->kit_type_id != null)
                
                <option class="text-primary font-weight-bolder" value="{{$kit->kitType->id}}"> {{$kit->kitType->name.' - $'.$kit->kitType->precio}}</option>
            @else
                <option class="text-primary font-weight-bolder" value="{{NULL}}"> No fue cargado el tipo de kit</option>
            @endif
        @endif
        
        <option value="{{NULL}}">Sin kit</option>
        @foreach ($kitTypes as $k)
            
        <option value="{{$k->id}}">{{$k->name.' - $'.$k->precio}}</option>
        @endforeach
    </select>
</div>