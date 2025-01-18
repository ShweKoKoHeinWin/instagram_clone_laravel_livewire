<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class Home extends Component
{
    public $user;

    public function mount($user) {
        $this->user = User::whereUser_name($user)->withCount(['followers', 'followings', 'posts'])->firstOrFail();
    }

    #[On('closeModal')]
    public function revertUrl() {
        $this->js("history.replaceState({}, '', '/profile/{$this->user->user_name}');");
    }

    public function toggleFollow() {
        abort_unless(auth()->check(), 401);
        auth()->user()->toggleFollow($this->user);
    }

    public function render()
    {
        $this->user = User::whereUser_name($this->user->user_name)->withCount(['followers', 'followings', 'posts'])->firstOrFail();
        $posts = $this->user->posts()->whereType('post')->get();
        return view('livewire.profile.home', compact('posts'));
    }
}
