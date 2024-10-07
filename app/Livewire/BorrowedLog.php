<?php

namespace App\Livewire;

use App\Livewire\Forms\BorrowEquipmentForm;
use App\Models\BorrowedEquipment;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class BorrowedLog extends Component
{
    use WithPagination;
   

    public function render()
    {
        return view('livewire.borrowed-log', [
            'logs' => BorrowedEquipment::with('equipment')->paginate(10)
        ]);
    }
}
