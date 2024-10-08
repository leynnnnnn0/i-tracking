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
            'logs' => BorrowedEquipment::with('equipment')->latest()->paginate(10)
        ]);
    }

    public function delete($id): void
    {
        BorrowedEquipment::findOrFail($id)->delete();
        Toaster::success('Successfully Deleted!');
        $this->dispatch('Data Deleted');
    }
}
