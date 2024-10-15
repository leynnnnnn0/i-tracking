<?php

namespace App\Livewire\BorrowerLog;

use App\Models\BorrowedEquipment;
use Livewire\Component;

class View extends Component
{
    public $borrowedEquipment;
    public function mount($id)
    {
        $this->borrowedEquipment = BorrowedEquipment::with('equipment')->findOrFail($id);
    }
    public function render()
    {
        return view('livewire.borrower-log.view');
    }
}
