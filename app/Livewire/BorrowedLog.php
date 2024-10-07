<?php

namespace App\Livewire;

use App\Models\BorrowedEquipment;
use Livewire\Component;
use Livewire\WithPagination;

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
