<?php

namespace App\Livewire;

use App\Models\MissingEquipment as ModelsMissingEquipment;
use Livewire\Component;

class MissingEquipment extends Component
{
    public function render()
    {
        return view('livewire.missing-equipment', [
            'data' => ModelsMissingEquipment::latest()->paginate(10)
        ]);
    }
}
