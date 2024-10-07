<?php

namespace App\Livewire;

use App\Models\Equipment;
use Livewire\Component;
use Livewire\WithPagination;

class Equipments extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.equipments', [
            'equipments' => Equipment::with('responsible_person', 'borrowed_log')->latest()->paginate(10)
        ]);
    }
}
