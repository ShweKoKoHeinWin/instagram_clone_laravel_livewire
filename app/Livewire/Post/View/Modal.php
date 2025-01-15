<?php

namespace App\Livewire\Post\View;

use App\Models\Post;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use PhpParser\Node\Expr\AssignOp\Mod;

class Modal extends ModalComponent
{
    public $post;

    public function mount() {
        $this->post = Post::find($this->post);
        $url = route('post.view', $this->post);

        // push state using livewire js helper
        $this->js("history.pushState({}, '', '{$url}');");
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public function render()
    {
        return <<<'BLADE'
        <main class="bg-white h-[calc(100vh-3.5rem)] md:h-[calc(100vh-5rem)] flex flex-col border gap-y-4 px-5 py-4">
            <livewire:post.view.item :post="$this->post" />
        </main>
        BLADE;
    }
}
