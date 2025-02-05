<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class Home extends Component
{
    public $posts = [];
    public $canLoadMore = true;
    public $perPage = 5;
    public $perPageIncrements = 5;

    #[On('post-created')]
    public function postCreated($id) {
        $post =  Post::with('user', 'media')->find($id);
        $this->posts = $this->posts->prepend($post);
    }

    #[On('closeModal')]
    public function revertUrl() {
        $this->js("history.replaceState({}, '', '/');");
    }

    public function loadMore() {
        if(!$this->canLoadMore) {
            return null;
        }

        $this->perPage += $this->perPageIncrements;
        $this->loadPosts();
    }

    public function loadPosts() {
        $this->posts = Post::with('comments.replies')->latest()->take($this->perPage)->get();

        $this->canLoadMore = (count($this->posts) >= $this->perPage);
    }

    public function mount() {
        // $this->posts = Post::with('user', 'media', 'comments')->whereHas('comments')->latest()->get();
        $this->loadMore();

    }

    public function render()
    {
        $suggestedUsers = User::limit(5)->get();
        return view('livewire.home', compact('suggestedUsers'));
    }

    public function toggleFollow(User $user) {
        auth()->user()->toggleFollow($user);
    }
}
