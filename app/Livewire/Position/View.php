<?php

namespace App\Livewire\Position;

use App\Models\Position;
use Livewire\Component;

class View extends Component
{
    public $position;

    public function mount($id)
    {
        $this->position = Position::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.position.view');
    }
}
