<?php

namespace App\Livewire\MissingEquipment;

use App\Models\MissingEquipment;
use Livewire\Component;

class View extends Component
{
    public $equipment;

    public function mount($id)
    {
        $this->equipment = MissingEquipment::with('equipment', 'equipment.responsible_person', 'equipment.accounting_officer')->findOrFail($id);
    }
    public function render()
    {
        return view('livewire.missing-equipment.view');
    }
}
