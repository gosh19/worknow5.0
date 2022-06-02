<div class="card">
    <div class="card-header bg-green-600 font-bold text-gray-100">Portada</div>
    <div class="card-body">
        <form wire:submit.prevent="save">
            <input type="file" wire:model="photo">
         
            @error('photo') <span class="error">{{ $message }}</span> @enderror
         
            <button type="submit">Save Photo</button>
        </form>
        <hr class="my-3">
      <img src="{{ asset('/storage/banners/banner-'.$bannerId) }}" alt="">
    </div>
    <hr>
    
  </div>