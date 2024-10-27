<?php

namespace App\Livewire\BorrowerLog;

use App\Enum\BorrowStatus;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\BorrowEquipmentForm;
use App\Models\BorrowedEquipment;
use App\Models\Equipment;
use App\Traits\Updatable;
use Livewire\Component;
use Illuminate\Support\Str;

class Edit extends Component
{
    use Updatable;
    public BorrowEquipmentForm $form;
    public BorrowedEquipment $borrowedEquipment;
    public ActivityLogForm $activityLogForm;
    public $equipments;
    public $quantityHint = "";
    public $statuses;

    protected function beforeTransaction()
    {
        $form = $this->form;
        if ($form->status === 'partially_returned') {
            $form->total_quantity_returned += $form->quantity_returned;
        }
        if ($form->status === 'returned') {
            $form->returned_date = date('Y-m-d');
        }
    }

    protected function getRedirectRoute(): string
    {
        return 'borrowed-logs';
    }

    protected function getEloquentModel()
    {
        return $this->borrowedEquipment;
    }

    public function mount($id)
    {
        $this->statuses = collect(BorrowStatus::cases())
            ->map(fn($status) => [
                'value' => $status->value,
                'label' => Str::headline($status->value)
            ])
            ->values()
            ->toArray();

        $this->borrowedEquipment = BorrowedEquipment::findOrFail($id);
        $this->form->setBorrowEquipment($this->borrowedEquipment);
        $this->equipments = Equipment::where('quantity_available', '>', 0)
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
