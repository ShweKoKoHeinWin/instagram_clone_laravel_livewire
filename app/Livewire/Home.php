<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class Home extends Component
{
    public $posts = [];

    #[On('post-created')]
    public function postCreated($id) {
        $post =  Post::with('user', 'media')->find($id);
        $this->posts = $this->posts->prepend($post);
    }

    #[On('closeModal')]
    public function revertUrl() {
        $this->js("history.replaceState({}, '', '/');");
    }

    public function mount() {
        $this->posts = Post::with('user', 'media')->latest()->get();
    }

    public function render()
    {
        return view('livewire.home');
    }
}
