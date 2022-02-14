<div class="grid grid-cols-2">
    <div class="col-span-1">
        <ul>
            @foreach ($cant as $item)
            <li>{{$item['type']}}: {{$item['cant']}}</li>
            @endforeach
        </ul>
        <ul>
            @foreach ($cantCountry as $item)
            <li>{{$item['country']}}: {{$item['cant']}}</li>
            @endforeach
        </ul>
    </div>
    <div class="col-span-1">
        <ul>
            @foreach ($cantCursos as $item)
            <li>{{$item['curso']}}: {{$item['cant']}}</li>
            @endforeach
        </ul>
    </div>
</div>
