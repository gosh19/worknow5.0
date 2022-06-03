<div class="card">
    <div class="card-header bg-green-600 font-bold text-gray-100 flex justify-between">
      <span>Portada (1024x768)</span>
      <div wire:loading>
        <i class="fa-solid fa-spinner animate-spin"></i>
      </div>
    </div>
    <div class="card-body">
        <form class="flex justify-between" wire:submit.prevent="save">
            <input type="file" wire:model="photo" />
         
            @error('photo') <span class="error">{{ $message }}</span> @enderror
         
            <button class="py-1 px-3 bg-green-400" type="submit">Guardar portada</button>
        </form>
        <hr class="my-3">
        <div class="flex">
          @foreach ($banners as $key => $ban)
              <img wire:click="updateBanner({{$key}})" class="w-28 h-20 px-1 cursor-pointer" src="{{ asset('/storage/'.$ban['url']) }}" alt="">
          @endforeach
        </div>
        
        <hr class="my-3">
      <img class="border-4 border-green-300" wire:loading.class=" animate-pulse" wire:loading.class.remove="border-4 border-green-300" src="{{ asset('/storage/'.$selectedBanner) }}" alt="">
    </div>
    <hr>
    
  </div>