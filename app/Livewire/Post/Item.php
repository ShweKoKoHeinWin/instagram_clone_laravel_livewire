<?php

namespace App\Livewire\Post;

use App\Models\Post;
use App\Models\Comment;
use App\Notifications\NewCommentNotification;
use Livewire\Component;
use App\Notifications\PostLikedNotification;

class Item extends Component
{
    public Post $post;
    public $body = '';

    public function togglePostLike() {
        abort_unless(auth()->check(), 401);

        auth()->user()->toggleLike($this->post);

        if($this->post->isLikedBy(auth()->user())) {
            if($this->post->user_id != auth()->id()) {
                $this->post->user->notify(new PostLikedNotification(auth()->user(), $this->post));
            }
        }
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

        $comment = Comment::create([
            'body' => $this->body,
            'parent_id' => null,
            'user_id' => auth()->user()->id,
            'commentable_id' => $this->post->id,
            'commentable_type' => Post::class,
        ]);
        if($this->post->user_id != auth()->id()) {
            $this->post->user->notify(new NewCommentNotification(auth()->user(), $comment));
        }
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
