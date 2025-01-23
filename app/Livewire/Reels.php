<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class Reels extends Component
{
    #[On('closeModal')]
    public function revertUrl() {
        $this->js("history.replaceState({}, '', '/')");
    }

    public function togglePostLike(Post $reel) {
        abort_unless(auth()->check() , '403');
        auth()->user()->toggleLike($reel);
    }

    public function render()
    {
        $reels = Post::limit(20)->where('type', 'reel')->get();
        return view('livewire.reels', compact('reels'));
    }
}
