<?php

namespace App\Livewire\Post;

use Livewire\Component;

class Item extends Component
{
    public $post;

    public function mount($post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.post.item');
    }
}
