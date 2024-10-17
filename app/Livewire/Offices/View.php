<?php

namespace App\Livewire\Offices;

use App\Models\Office;
use Livewire\Component;

class View extends Component
{
    public $office;

    public function mount($id)
    {
        $this->office = Office::findOrFail($id);
    }
    
    public function render()
    {
        return view('livewire.offices.view');
    }
}
