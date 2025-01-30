<?php

namespace App\Livewire\Profile;

use App\Models\Conversation;
use App\Models\User;
use App\Notifications\NewFollowerNotification;
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

        // send noti
        if(auth()->user()->isFollowing($this->user)) {
            $this->user->notify(new NewFollowerNotification(auth()->user()));
        }
    }

    public function message($user_id) {
        $auth_user_id = auth()->id();
        $existingConversation = Conversation::where(function($query) use($auth_user_id, $user_id) {
            $query->where('sender_id', $auth_user_id)
                ->where('receiver_id', $user_id);
        })->orWhere(function($query) use($auth_user_id, $user_id) {
            $query->where('sender_id', $user_id)
                ->where('receiver_id', $auth_user_id);
        })->first();

        if($existingConversation) {
            return redirect()->route('chats.main', ['chat' => $existingConversation->id]);
        }

        $createdConversation = Conversation::create([
            'sender_id' => $auth_user_id,
            'receiver_id' => $user_id
        ]);

        return redirect()->route('chats.main', ['chat' => $createdConversation]);
    }

    public function render()
    {
        $this->user = User::whereUser_name($this->user->user_name)->withCount(['followers', 'followings', 'posts'])->firstOrFail();
        $posts = $this->user->posts()->whereType('post')->get();
        return view('livewire.profile.home', compact('posts'));
    }
}
