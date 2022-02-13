<?php

namespace App\Http\Livewire\Foro;

use Livewire\Component;

class Comment extends Component
{
    public $post;
    public $comment;

    public function mount(\App\Post $post, \App\PostComment $comment)
    {
        $this->post = $post;
        $this->comment = $comment;
    }

    public function render()
    {
        return view('livewire.foro.comment',['post'=> $this->post, 'comment' => $this->comment]);
    }
}
