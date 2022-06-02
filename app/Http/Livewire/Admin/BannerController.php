<?php

namespace App\Http\Livewire\Admin;
use Livewire\WithFileUploads;
use App\Models\Banner;

use Livewire\Component;

class BannerController extends Component
{
    use WithFileUploads;
 
    public $photo;
    public $banner;
    public $bannerId;

    public function mount()
    {
        $this->banner = Banner::orderBy('id','desc')->first();

        $this->bannerId = $this->banner == null? 0:$this->banner->id;

    }
 
    public function save()
    {
 
        $this->photo->storeAs('banners', 'banner-'.($this->bannerId+1),'public');
        $ban = new Banner;
        $ban->save();
        $this->bannerId = $ban->id;
    }

    public function render()
    {
        return view('livewire.admin.banner-controller');
    }
}
