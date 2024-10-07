<?php

namespace App\Livewire;

use App\Models\Equipment;
use Livewire\Component;

class Equipments extends Component
{
    public $equipments;
    public function mount()
    {
        $this->equipments = Equipment::with('responsible_person')->get();
    }
    public function render()
    {
        return view('livewire.equipments');
    }
}
