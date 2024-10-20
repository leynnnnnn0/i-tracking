<?php

namespace App\Livewire\BorrowerLog;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\BorrowEquipmentForm;
use App\Models\Equipment;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public BorrowEquipmentForm $form;
    public ActivityLogForm $activityLogForm;
    public $equipments;
    public $quantityHint = "";

    public function mount()
    {
        $this->equipments = Equipment::where('status', 'Active')
            ->where('quantity', '>', 0)
            ->select('id', 'name', 'property_number')
            ->get()
            ->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => "{$item->name} (PN: {$item->property_number})"
                ];
            })
            ->toArray();
    }
    public function render()
    {
        if ($this->form->equipment_id) {
            $this->quantityHint = "Equipment quantity: " . Equipment::select('quantity')->find($this->form->equipment_id)->quantity;
        }
        return view('livewire.borrower-log.create');
    }

    public function submit()
    {
        try {
            DB::transaction(function () {
                $data = $this->form->store();
                $this->activityLogForm->setActivityLog(null, $data, 'Created Borrow Log', 'Create');
                $this->activityLogForm->store();
                $this->form->reset();
            });
            Toaster::success('Successfully Created!');
            return $this->redirect('/borrowed-logs');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
            throw $e;
        }
    }
}
