<?php

namespace App\Livewire\BorrowerLog;

use App\Enum\BorrowStatus;
use App\Enum\MissingStatus;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\BorrowEquipmentForm;
use App\Models\BorrowedEquipment;
use App\Models\Equipment;
use App\Models\MissingEquipment;
use App\Traits\Updatable;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;

class Edit extends Component
{
    use Updatable;
    public BorrowEquipmentForm $form;
    public BorrowedEquipment $borrowedEquipment;
    public ActivityLogForm $activityLogForm;
    public $equipments;
    public $quantityHint = "";
    public $statuses;
    #[Rule('required')]
    public $reportedBy;

    // Missing Equipmen Details

    protected function beforeTransaction()
    {
        $form = $this->form;
        if ($form->status === 'partially_returned') {
            $form->total_quantity_returned += $form->quantity_returned;
        } else if ($form->status === 'returned') {
            $form->total_quantity_returned = $form->quantity;
            $form->returned_date = date('Y-m-d');
        } else if ($form->status === 'partially_missing') {
            $this->validateOnly('reportedBy');
            $form->total_quantity_missing += $form->quantity_missing;
        } else if ($form->status === BorrowStatus::MISSING->value) {
            $this->validateOnly('reportedBy');
            $form->quantity_missing = $form->quantity;
            $form->total_quantity_missing = $form->quantity;
        } else if ($form->status === BorrowStatus::RETURNED_WITH_MISSING->value) {
            $this->validateOnly('reportedBy');
            $form->quantity_returned = $form->quantity - $form->quantity_missing;
            $form->total_quantity_returned += $form->quantity_returned;
            $form->total_quantity_missing += $form->quantity_missing;
        }
    }

    protected function afterTransaction($model)
    {
        if ($this->form->status === 'partially_missing' || $this->form->status == 'returned_with_missing' || $this->form->status === 'partially_returned_with_missing' || $this->form->status = 'missing') {
            MissingEquipment::create([
                'equipment_id' => $model->equipment_id,
                'reported' => MissingStatus::REPORTED->value,
                'reported_by' => $this->reportedBy,
                'reported_date' => date('Y-m-d'),
                'quantity' => $model->quantity_missing,
            ]);
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
