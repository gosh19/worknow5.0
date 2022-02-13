<?php

namespace App\Http\Livewire\Foro;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class Post extends Component
{
    public $post;

    public $comment = '';
    public $comentarios;
    public $debug = 1;

    protected $listeners = ['comment' => 'reloadComments', 'sendNotis'];

    public function mount(\App\Post $post)
    {
        $this->post = $post;
        $this->comentarios = $post->comments;
    }

    public function reloadComments()
    {
        
        $this->comentarios = $this->post->comments;
    }

    public function sendNotis($post)
    {
        \App\PostNotification::sendNotification($post['user_id'],'comentario',$post['id']);
    }

    public function postComment()
    {
        $com = new \App\PostComment;

        $com->user_id = auth()->id();
        $com->post_id = $this->post->id;
        $com->text = $this->comment;

        $com->save();

        $this->comment = '';
        $this->emit('comment');
        $this->emit('sendNotis',$this->post);
    }

    public function render()
    {
        return view('livewire.foro.post',['post' => $this->post]);
    }
}
