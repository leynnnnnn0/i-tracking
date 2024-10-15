<?php

namespace App\Livewire;

use App\Models\Equipment;
use App\Models\Personnel;
use Livewire\Component;

class Dashboard extends Component
{
    public $availableEquipments;
    public $borrowedEquipments;
    public $personnels;
    public function mount()
    {
        $this->availableEquipments = Equipment::where('status', 'Available')->count();
        $this->availableEquipments = Equipment::where('status', 'Borrowed')->count();
        $this->personnels = Personnel::count();
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
