<?php

namespace App\Livewire;

use App\Enum\EquipmentStatus;
use App\Models\Equipment;
use App\Models\MissingEquipment as ModelsMissingEquipment;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class MissingEquipment extends Component
{
    public function render()
    {
        return view('livewire.missing-equipment', [
            'data' => ModelsMissingEquipment::with('equipment')->latest()->paginate(10)
        ]);
    }

    public function condemned($id)
    {
        $equipment = Equipment::findOrFail($id)->update([
            'status' => EquipmentStatus::CONDEMNED->value
        ]);
        $this->dispatch('Condemned');
        Toaster::success('Updated Successfully');
    }
}
