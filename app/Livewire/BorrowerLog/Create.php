<?php

namespace App\Livewire\BorrowerLog;

use App\Livewire\Forms\BorrowEquipmentForm;
use App\Models\Equipment;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    
    public BorrowEquipmentForm $form;
    public $equipments;

    public function mount()
    {
        $this->equipments = Equipment::where('status', 'Active')->get()->pluck('name', 'id');
    }
    public function render()
    {
        return view('livewire.borrower-log.create');
    }


    public function submit()
    {

        $this->form->store();
        Toaster::success('Successfully Created!');
        return $this->redirect('/borrowed-logs');
    }
}
