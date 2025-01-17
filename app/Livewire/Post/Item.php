<?php

namespace App\Livewire\Post;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;

class Item extends Component
{
    public $post;
    public $body = '';

    public function addComment() {
        $this->validate(['body' => 'required']);

        Comment::create([
            'body' => $this->body,
            'parent_id' => null,
            'user_id' => auth()->user()->id,
            'commentable_id' => $this->post->id,
            'commentable_type' => Post::class,
        ]);

        $this->reset('body');
    }

    public function mount($post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.post.item', [
            'comment_count' => $this->post->comments()->whereDoesntHave('parent')->count()
        ]);
    }
}
