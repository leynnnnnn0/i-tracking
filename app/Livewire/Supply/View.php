<?php

namespace App\Livewire\Supply;

use App\Models\Supply;
use Livewire\Component;

class View extends Component
{
    public $supply;

    public function mount($id)
    {
        $this->supply = Supply::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.supply.view');
    }
}
