<?php

namespace App\Livewire\Equipments;

use App\Models\Equipment;
use Livewire\Component;

class View extends Component
{
    public $equipment;
    public $query;
    public function mount($id)
    {
        $this->equipment = Equipment::withRelationships()->findOrFail($id);
        $this->query = request()->query('query');
    }
    public function render()
    {
        return view('livewire.equipments.view');
    }
}
