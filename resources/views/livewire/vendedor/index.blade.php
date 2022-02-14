<div>
    <h1 class="text-4xl font-bold text-red-400">Historial de ventas</h1>
    <div>
        <p>Selecciona un mes, año y tipo para ver el historial completo </p>
    </div>
    <hr class="my-2">
    <div class="grid grid-cols-2">
      
        <select wire:model="month" name="" id="">
            <option value="month">{{$month}}</option>
            @for ($i = 1; $i < 13; $i++)
                <option  value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
        <select wire:model="year" name="" id="">
            <option value="year">{{$year}}</option>
            @for ($i = 2020; $i < 2023; $i++)
                <option  value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
    </div>
    <div class="grid grid-cols-2 justify-items-center mb-3">
        <div class="">
            <button wire:click="$set('type', 'cerrada')"
                    class="p-2 bg-green-500 rounded text-white">Cerradas</button>
        </div>
        <div class="justify-center">
            <button wire:click="$set('type', 'pendiente')"
                    class="p-2 bg-yellow-500 rounded text-white">Pendientes</button>
        </div>
    </div>
    <div class="pl-3">

        <h2 class="text-3xl ">Datos de las ventas {{$type}} del mes {{$month}}</h2>
        <h3 class="text-2xl ">Puntos sumados: {{$vendedor->puntosMes($month)}}</h3>
        <small>solo contabiliza los puntos del año corriente</small>
    </div>
    <table class="border w-full">
        @if ($type == 'cerrada')
        <thead class="bg-green-600 font-bold text-white text-center">
        @else
        <thead class="bg-yellow-600 font-bold text-white text-center">  
        @endif
            <th class="border-2 border-black">Fecha</th>
            <th class="border-2 border-black">#</th>
            <th class="border-2 border-black">Nombre</th>
            <th class="border-2 border-black">email</th>
            <th class="border-2 border-black">Telefono</th>
            <th class="border-2 border-black">Tipo</th>
            <th class="border-2 border-black">Comision</th>
        </thead>
        <tbody>

            @foreach ($ventas as $venta)
                @livewire('vendedor.item', ['venta' => $venta], key($venta->id))
            @endforeach
        </tbody>
    </table>
</div>

