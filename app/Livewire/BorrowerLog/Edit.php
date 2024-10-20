<?php

namespace App\Livewire\BorrowerLog;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\BorrowEquipmentForm;
use App\Models\BorrowedEquipment;
use App\Models\Equipment;
use Carbon\Carbon;
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
    public $quantityHint = "";

    public function mount($id)
    {
        $this->borrowedEquipment = BorrowedEquipment::findOrFail($id);
        $this->form->setBorrowEquipment($this->borrowedEquipment);
        $this->equipments = Equipment::where('status', 'Borrowed')->get()->pluck('name', 'id');
        $this->form->returned_date =  Carbon::today()->format('Y-m-d');
    }
    public function render()
    {
        if ($this->form->equipment_id) {
            $this->quantityHint = "Equipment quantity: " . Equipment::select('quantity')->find($this->form->equipment_id)->quantity;
        }
        return view('livewire.borrower-log.edit');
    }

    public function update()
    {
        $this->dispatch('Confirm Update');
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
            throw $e;
        }
    }
}
