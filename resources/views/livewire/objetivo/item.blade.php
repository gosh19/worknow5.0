<div x-data="custom()">
    <div class="flex justify-between">
        <h1 class="text-xl text-gray-800">{{$custom->name}}</h1>
        <div x-show.transition.duration.200ms="edit">
            <input type="text" class="border-2 border-orange-500 p-1 rounded" wire:model="name" >
        </div>
    </div>
    <hr class="border-2 border-red-800 my-2">
    <div class="grid grid-flow-row gap-4">
        <div class="row-span-1 flex justify-between">
            <div>
                <p>
                    Objetivo : {{$custom->objetivo}}
                </p>
                <div x-show.transition.duration.200ms="edit">
                    <input type="text" class="border-2 border-orange-500 p-1 rounded" wire:model="objetivo" >
                </div>
            </div>
            <div>
                <p>
                    Premio : {{$custom->premio}}
                </p>
                <div x-show.transition.duration.200ms="edit">
                    <input type="text" class="border-2 border-orange-500 p-1 rounded" wire:model="premio" >
                </div>
            </div>
        </div>
        <div class="row-span-1 flex justify-between">
            <div>
                <p>
                    Inicio : {{$custom->desde}}
                </p>
                <div x-show.transition.duration.200ms="edit">
                    <input type="date" class="border-2 border-orange-500 p-1 rounded" wire:model="desde" >
                </div>
            </div>
            <div>
                <p>
                    Fin : {{$custom->hasta}}
                </p>
                <div x-show.transition.duration.200ms="edit">
                    <input type="date" class="border-2 border-orange-500 p-1 rounded" wire:model="hasta" >
                </div>
            </div>
        </div>
    </div>
    <hr class="border-2 border-red-800 my-2">
    <div class="flex justify-between">
        <a href="{{route('Objetivo.deleteCustom',['custom'=>$custom])}}" 
            onclick="return confirm('¿Seguro que deseas eliminar el objetivo {{$custom->name}} ?')"
            class="text-white py-1 px-3 bg-red-800 rounded"><i class="fas fa-trash-alt"></i></a>
        <div>
            <button x-show.transition.duration.200ms="edit" 
                    wire:click="updateData()"
                    class="text-white py-1 px-3 bg-green-500 rounded"
            ><i class="fas fa-save"></i></button>
            <button @click="wea()" class="text-white py-1 px-3  rounded" :class="{'bg-blue-800': !edit,'bg-red-600':edit}">
                <i class="fas" :class="{'fa-pen': !edit,'fa-times':edit}"></i>
            </button>

        </div>
    </div>
</div>

<script>
    function custom() {
        return{
            edit: @entangle('edit'),
            wea(){
                this.edit=!this.edit;
            }
        }
    }
</script>
