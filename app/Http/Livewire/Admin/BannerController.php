<?php

namespace App\Http\Livewire\Admin;
use Livewire\WithFileUploads;
use App\Models\Banner;

use Livewire\Component;

class BannerController extends Component
{
    use WithFileUploads;
 
    public $photo;
    public $banners;
    public $bannerId;
    public $selectedBanner;
    public $debug;

    public function mount()
    {
        $this->banners = Banner::orderBy('id','desc')->orderBy('selected','desc')->take(6)->get();


        $this->bannerId = count($this->banners) == 0? 0:$this->banners[0]['id'];
        $this->selectedBanner = count($this->banners) == 0? 0:$this->banners[0]['url'];

    }
 
    public function save()
    {
        $path = $this->photo->store(
            'banners', 'public'
        );
        $ban = new Banner;
        $ban->url = $path;
        $ban->selected = 1;
        $ban->save();

        $this->selectedBanner = $ban->url;
        
        $banner = Banner::find($this->bannerId);
        if ($banner != null) {
            $banner->selected = false;
            $banner->save();
        }
        $this->bannerId = $ban->id;

        $this->banners = Banner::orderBy('id','desc')->take(6)->get();
    }

    public function updateBanner($key)
    {
        $ban = Banner::find($this->bannerId);
        $ban->selected = 0;
        $ban->save();

        $ban = Banner::find($this->banners[$key]['id']);
        $ban->selected = 1;
        $ban->save();

        $this->bannerId = $ban->id;
        $this->selectedBanner = $ban->url;
    }

    public function render()
    {
        return view('livewire.admin.banner-controller');
    }
}
