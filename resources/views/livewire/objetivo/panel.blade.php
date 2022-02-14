<div x-data="panel()" class="grid grid-cols-3">
    <div class="col-span-1 border-2 border-red-400 p-3 m-3 h-80">
        <div>
            <h1 class="text-xl text-red-500">Panel de creacion de objetivos</h1>
        </div>
        <hr class="my-2 border-2 border-red-500">
        <div x-show="!loading" class="grid grid-flow-row gap-4" >
            <div class="row-span-1 flex justify-between">
                <label for="">Nombre</label>
                <input type="text" class="p-1 border-2 border-red-400"
                        placeholder="Nombre..."
                        wire:model="name"
                >
            </div>
            <div class="row-span-1 flex justify-between">
                <label for="">Objetivo</label>
                <input type="number" class="p-1 border-2 border-red-400" wire:model="objetivo">
            </div>
            <div class="row-span-1 flex justify-between">
                <label for="">Premio</label>
                <input type="number" class="p-1 border-2 border-red-400" wire:model="premio">
            </div>
            <div class="row-span-1 flex justify-between">
                <input type="date" class="p-1 border-2 border-red-400"  wire:model="desde">
                <input type="date" class="p-1 border-2 border-red-400" wire:model="hasta" >
            </div>
            <div class="row-span-1">
                <button class="w-full bg-red-700 py-1 text-white font-bold" wire:click="crearObjetivo()">Crear</button>
            </div>
        </div>
        <div x-show="loading" class="h-full flex">
            <div class=" flex flex-1 self-center justify-center">

                <i class="fas fa-spinner fa-4x animate-spin "></i>
            </div>
        </div>
    </div>
    <div class="col-span-2 grid grid-cols-2 gap-4">
        @foreach ($customs as $custom)
            <div class="col-span-1">
                <div class="col-span-1 border-2 border-gray-200 p-3 shadow-xl">
                    @livewire('objetivo.item', ['custom' => $custom], key($custom->id))
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    function panel(){
        return {
            loading: @entangle('loading'),
        }
    }
</script>
