<?php

namespace App\Livewire\BorrowerLog;

use App\Livewire\Forms\BorrowEquipmentForm;
use App\Models\BorrowedEquipment;
use App\Models\Equipment;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    public BorrowEquipmentForm $form;
    public BorrowedEquipment $borrowedEquipment;
    public $equipments;

    public function mount($id)
    {
        $this->borrowedEquipment = BorrowedEquipment::findOrFail($id);
        $this->form->setBorrowEquipment($this->borrowedEquipment);
        $this->equipments = Equipment::where('is_borrowed', false)->get()->pluck('name', 'id');
        
    }
    public function render()
    {
        return view('livewire.borrower-log.edit');
    }

    public function update() {
        $this->form->update($this->borrowedEquipment);
        Toaster::success('Updated Successfully!');
        return $this->redirect('/borrowed-logs');

    }
}
