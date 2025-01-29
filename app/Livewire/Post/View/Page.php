<?php

namespace App\Livewire\Post\View;

use App\Models\Post;
use Livewire\Component;

class Page extends Component
{
    public $post;
    public function mount(Post $post) {
        $this->post = $post;
    }
    public function render()
    {
        return <<<'HTML'
        <main class="bg-white min-h-screen mx-auto flex flex-col gap-y-4 px-5">
            <div class="border px-2 h-[calc(100vh-3.5rem)] my-auto">
                <livewire:post.view.item :post="$this->post"/>
            </div>
        </main>
        HTML;
    }
}
