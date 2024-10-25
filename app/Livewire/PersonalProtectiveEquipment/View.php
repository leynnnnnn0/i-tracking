<?php

namespace App\Livewire\PersonalProtectiveEquipment;

use App\Models\PersonalProtectiveEquipment;
use Livewire\Component;

class View extends Component
{
    public $equipment;

    public function mount($id)
    {
        $this->equipment = PersonalProtectiveEquipment::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.personal-protective-equipment.view');
    }
}
