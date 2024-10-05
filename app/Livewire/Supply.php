<?php

namespace App\Livewire;

use App\Models\Supply as ModelsSupply;
use Livewire\Component;

class Supply extends Component
{
    public $data;
    public function mount()
    {
        $this->data = ModelsSupply::all();
    }
    public function render()
    {
        return view('livewire.supply');
    }
}
