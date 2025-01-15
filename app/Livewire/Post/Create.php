<?php

namespace App\Livewire\Post;

use App\Models\Media;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    use WithFileUploads;

    public $media = [];
    public $description;
    public $location;
    public $hide_like_view = false;
    public $allow_commenting = false;

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function submit() {
        $this->validate([
            'media.*' => 'required|file|max:102400|mimes:jpg,jpeg,png,mp4,mov',
            'allow_commenting' => 'required|boolean',
            'hide_like_view' => 'required|boolean',
        ]);
        $type = $this->getPostType($this->media);

        $post = Post::create([
            'user_id' => auth()->user()->id,
            'description' => $this->description,
            'location' => $this->location,
            'hide_like_view' => $this->hide_like_view,
            'allow_commenting' => $this->allow_commenting,
            'type' => $type,
        ]);

        foreach ($this->media as $key => $media) {
            $mime = $this->getMime($media);
            $path = $media->store("media", 'public');
            $url = url(Storage::url($path));

            Media::create([
                'mediable_id' => $post->id,
                'mediable_type' => Post::class,
                'url' => $url,
                'mime' => $mime,
            ]);

        }
        $this->reset();
        $this->dispatch('closeModal');

        $this->dispatch('post-created', $post->id);

    }

    public function getPostType($media) {
        $type = 'image';
        if (count($media) === 1 && str()->contains($media[0]->getMimeType(), 'video')) {
            return 'reel';
        } else {
            return 'post';
        }
    }

    public function getMime($media) : string {
        if(str()->contains($media->getMimeType(), 'video')) {
            return 'video';
        } else {
            return 'image';
        }
    }

    public function render()
    {
        return view('livewire.post.create');
    }
}
