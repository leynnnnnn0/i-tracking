<?php

namespace App\Livewire\BorrowerLog;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\BorrowEquipmentForm;
use App\Models\BorrowedEquipment;
use App\Models\Equipment;
use App\Traits\Updatable;
use Livewire\Component;

class Edit extends Component
{
    use Updatable;
    public BorrowEquipmentForm $form;
    public BorrowedEquipment $borrowedEquipment;
    public ActivityLogForm $activityLogForm;
    public $equipments;
    public $quantityHint = "";

    protected function getRedirectRoute(): string
    {
        return 'borrowed-logs';
    }

    protected function getEloquentModel()
    {
        return $this->form->update($this->borrowedEquipment);
    }

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

        if ($this->form->equipment_id) {
            $equipment = Equipment::find($this->form->equipment_id);
            $this->quantityHint = "Available: " . $equipment->quantity - $equipment->quantity_borrowed;
        }
        return view('livewire.borrower-log.edit');
    }
}
