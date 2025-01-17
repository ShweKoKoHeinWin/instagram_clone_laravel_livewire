<?php

namespace App\Livewire\Post\View;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class Item extends Component
{
    public Post $post;
    public $body = '';
    public $parent_id = null;

    public function togglePostLike() {
        abort_unless(auth()->check(), 401);

        auth()->user()->toggleLike($this->post);
    }

    public function toggleFavourite() {
        abort_unless(auth()->check(), 401);

        auth()->user()->toggleFavorite($this->post);
    }

    public function toggleCommentLike(Comment $comment) {
        abort_unless(auth()->check(), 401);

        auth()->user()->toggleLike($comment);
    }

    public function addComment() {
        $this->validate(['body' => 'required']);

        Comment::create([
            'body' => $this->body,
            'parent_id' => $this->parent_id,
            'user_id' => auth()->user()->id,
            'commentable_id' => $this->post->id,
            'commentable_type' => Post::class,
        ]);

        $this->reset('body');
        $this->parent_id = null;
    }

    public function setParent(Comment $comment) {
        $this->parent_id = $comment->id;
        $this->body = "@{$comment->user->name} ";
    }

    public function render()
    {
        return view('livewire.post.view.item', [
            'comments' => $this->post->comments()->whereDoesntHave('parent')->get()
        ]);
    }
}
