<div x-data="{ open: false }">
    <tr>

        <td class="border">{{$venta->fecha}}</td>
        <td class="border">{{$venta->alumno}}</td>
        <td class="border">
            @if ($venta->estado == 'cerrada')
                
            {{$venta->datosAlumno->name}}
            @else
                <a href="alumno-pendiente/{{$venta->alumno}}">{{$venta->datosAlumno->name}}</a>
            @endif
        </td>
        <td class="border">{{$venta->datosAlumno->email}}</td>
        <td class="border">{{$venta->datosUser->telefono ?? ''}}</td>
        <td class="border">{{$venta->datosAlumno->tipo_pago ?? ''}}</td>
        <td class="border text-center"><button>$ {{$venta->comision}}</button></td>
    </tr>        
</div>
