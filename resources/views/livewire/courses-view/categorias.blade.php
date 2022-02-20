<div class="min-h-full" x-data="{showDropdown: false}">
    <p class="block md:hidden cursor-pointer py-3 text-lg bg-gray-100 w-full border-b-2 border-black pl-2"
        @click="showDropdown = !showDropdown">
        Cambiar categoria<i class="ml-3 fas fa-chevron-down "></i></p>
    <div  class="md:bg-none bg-gradient-to-tr from-blue-50 to-blue-100">
        @foreach ($categorias as $key => $categoria)
            <div
                class="hidden md:block px-2 py-1.5 text-white font-semibold transition transform hover:-translate-y-1 motion-reduce:transition-none motion-reduce:transform-none hover:text-blueGray-50">
                <p class="hover:text-blueGray-100 cursor-pointer"
                    wire:click="$emit('selectCategoria', {{ $categoria->id }})">{{ $categoria->name }}</p>
            </div>
            <div x-show="showDropdown"
                x-transition:enter.duration.500ms 
                x-transition:leave.duration.400ms
            >
                <div class="flex items-center text-lg pl-3" wire:click="$emit('selectCategoria', {{ $categoria->id }})">

                    <i class="fas fa-hand-point-right mr-3 text-blue-900"></i>
                    <p class="hover:text-blueGray-100 cursor-pointer py-1 ">{{ $categoria->name }}</p>
                </div>
                @if ($loop->last)
                    <div class="w-full border-b-2 border-gray-400 pt-3"></div>
                @endif
            </div>
        @endforeach
    </div>
</div>
