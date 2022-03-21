<div class="relative">
    <button class="p-1 bg-gray-300 rounded flex" data-bs-toggle="collapse" data-bs-target="#collapseCountry">
        <img class="w-10 h-7 " src="{{ asset($countries[$selected]) }}" alt="">
        <p class="font-bold ml-1 mb-0">${{$selected}}</p>
        <i class="fa-solid fa-chevron-down ml-1 my-auto inline-block"></i>
    </button>
    <div class="collapse absolute bg-white p-2 rounded" id="collapseCountry">
    @foreach ($countries as  $key => $country)
        @if ($key != session('country'))
        <a class="flex justify-between no-underline" href="{{route('intro',['country'=>$key])}}">
            <img class="w-10 h-7 cursor-pointer my-1" src="{{ asset($country) }}" alt="">
            <p class="font-bold ml-1 mb-0 my-auto inline-block text-blue-900 ">${{$key}}</p>
        </a>
        @endif
    @endforeach
    </div>
</div>
