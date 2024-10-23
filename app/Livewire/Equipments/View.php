<?php

namespace App\Livewire\Equipments;

use App\Models\Equipment;
use Livewire\Component;

class View extends Component
{
    public $equipment;
    public function mount($id)
    {
        $this->equipment = Equipment::with('personnel', 'accounting_officer')->findOrFail($id);
    }
    public function render()
    {
        return view('livewire.equipments.view');
    }
}
