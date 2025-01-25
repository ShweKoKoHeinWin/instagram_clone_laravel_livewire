<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Component;

class Sidebar extends Component
{
    public $shrink = false;
    public $drawer = false;
    public $results;
    public $query;

    public function updatedQuery($query) {
        if($query == '') {
            return $this->results = null;
        }
        $this->results = User::where('user_name', 'LIKE', '%' . $query . '%')->orWhere('name', 'LIKE', '%' . $query . '%')->get();
    }

    public function render()
    {
        return view('livewire.components.sidebar');
    }
}
