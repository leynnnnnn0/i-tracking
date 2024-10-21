<?php

namespace App\Livewire;

use App\Models\Equipment;
use App\Models\MissingEquipment;
use App\Models\Personnel;
use App\Models\Supply;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
    public $availableEquipments;
    public $borrowedEquipments;
    public $personnels;
    public $missingEquipments;
    public function mount()
    {
        $this->availableEquipments = Equipment::where('status', 'Active')->count();
        $this->borrowedEquipments = Equipment::where('status', 'Borrowed')->count();
        $this->personnels = Personnel::count();
        $this->missingEquipments = MissingEquipment::where('is_condemned', false)->count();
    }
    public function render()
    {
        return view('livewire.dashboard', [
            'supplies' => Supply::where('total', '<=', 10)->paginate(10)
        ]);
    }
}
