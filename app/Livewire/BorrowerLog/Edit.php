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
        $this->equipments = Equipment::where('quantity', '>', 0)
            ->get()
            ->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => $item->name
                ];
            })->toArray();
    }
    public function render()
    {

        // Availble quantity = quantity - borrowed equipomt 
        if ($this->form->equipment_id) {
            $equipment = Equipment::find($this->form->equipment_id);
            $this->quantityHint = "Available: " . $equipment->quantity - $equipment->quantity_borrowed;
        }
        return view('livewire.borrower-log.edit');
    }

    public function update()
    {
        $this->dispatch('Confirm Update');
        $this->form->validate();
        try {
            DB::transaction(function () {
                if ($this->form->is_returned) {
                    $this->form->returned_date =  Carbon::today()->format('Y-m-d');
                }
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
