<?php

namespace App\Livewire\BorrowerLog;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\BorrowEquipmentForm;
use App\Models\BorrowedEquipment;
use App\Models\Equipment;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    public BorrowEquipmentForm $form;
    public BorrowedEquipment $borrowedEquipment;
    public ActivityLogForm $activityLogForm;
    public $equipments;

    public function mount($id)
    {
        $this->borrowedEquipment = BorrowedEquipment::findOrFail($id);
        $this->form->setBorrowEquipment($this->borrowedEquipment);
        $this->equipments = Equipment::where('status', 'Borrowed')->get()->pluck('name', 'id');
    }
    public function render()
    {
        return view('livewire.borrower-log.edit');
    }

    public function update()
    {
        try {
            DB::transaction(function () {
                $equipment = $this->form->update($this->borrowedEquipment);

                $this->activityLogForm->setActivityLog($this->borrowedEquipment, $equipment, 'Updated Borrow Log', 'Update');
                $this->activityLogForm->store();
            });
            Toaster::success('Updated Successfully!');
            return $this->redirect('/borrowed-logs');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
