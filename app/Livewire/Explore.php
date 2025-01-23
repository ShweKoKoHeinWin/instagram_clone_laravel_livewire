<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;

class Explore extends Component
{
    #[On('closeModal')]
    public function revertUrl() {
        $this->js("history.replaceState({}, '', '/explore');");
    }

    public function render()
    {
        $posts = Post::all();
        return view('livewire.explore', compact('posts'));
    }
}
