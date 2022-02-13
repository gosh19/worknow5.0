<?php

namespace App\Http\Livewire\Foro;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

class Like extends Component
{
    public $hasLike = false;
    public $cant = 0;
    public $post;
    public $debug = "xd";

    public function mount(\App\Post $post)
    {
        $this->post = $post;
        $this->hasLike = $post->userLike(auth()->id());
        $this->cant = count($post->likes);
    }

    public function like()
    {
        $this->debug = 65;
        $like = \App\PostLike::where([['user_id',Auth::id()],['post_id',$this->post->id]])->first();

        if ($like == null) {
            $like = new \App\PostLike;

            $like->user_id = Auth::id();
            $like->post_id = $this->post->id;

            $like->save();

            \App\PostNotification::sendNotification($this->post->user_id,'like',$this->post->id);
            $this->cant++;
        } else {
            $like->delete();
            $this->cant--;
        }
        
        $this->hasLike = !$this->hasLike;
    }

    public function render()
    {
        return view('livewire.foro.like',['hasLike'=> $this->hasLike, 'cant'=> $this->cant]);
    }
}
