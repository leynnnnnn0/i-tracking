<?php

namespace App\Livewire;

use App\Models\Equipment;
use App\Models\MissingEquipment;
use App\Models\Personnel;
use Livewire\Component;

class Dashboard extends Component
{
    public $availableEquipments;
    public $borrowedEquipments;
    public $personnels;
    public $missingEquipments;
    public function mount()
    {
        $this->availableEquipments = Equipment::where('status', 'Available')->count();
        $this->availableEquipments = Equipment::where('status', 'Borrowed')->count();
        $this->personnels = Personnel::count();
        $this->missingEquipments = MissingEquipment::count();
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
