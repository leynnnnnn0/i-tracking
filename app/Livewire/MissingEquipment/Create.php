<?php

namespace App\Livewire\MissingEquipment;

use App\Enum\MissingStatus;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\MissingEquipmentForm;
use App\Models\Equipment;
use App\Models\MissingEquipment;
use App\Traits\Submittable;
use Carbon\Carbon;

use Livewire\Component;

use TallStackUi\Traits\Interactions;

class Create extends Component
{
    use Submittable, Interactions;
    public ActivityLogForm $activityLogForm;
    public MissingEquipmentForm $form;
    public $statuses;
    public $equipments;

    public $quantityHint = "";

    protected function getModelName(): string
    {
        return 'missing equipment';
    }

    protected function performStoreOperation()
    {
        return $this->form->store();
    }

    public function mount()
    {
        $this->form->reported_date = Carbon::today();
        $this->equipments = Equipment::select('id', 'name', 'property_number')
            ->where('quantity', '>', 0)
            ->get()
            ->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => "{$item->name} (PN: {$item->property_number})"
                ];
            })
            ->toArray();
        $this->statuses = MissingStatus::values();
    }
    public function render()
    {
        return view('livewire.missing-equipment.create');
    }

    public function updatedFormEquipmentId()
    {
        if ($this->form->equipment_id) {
            $this->quantityHint = "Equipment quantity: " . Equipment::select('quantity')->find($this->form->equipment_id)->quantity;
        }
    }

    public function updatedFormQuantity()
    {
        $this->test();
    }

    public function test()
    {
        if ($this->form->equipment_id && $this->form->quantity) {
            $report = MissingEquipment::where('quantity', $this->form->quantity)
                ->whereNot('is_condemned')
                ->where('equipment_id', $this->form->equipment_id)
                ->first();
            if ($report) {
                $this->dialog()->warning(
                    'Duplicate Report Found',
                    'A report with the same missing quantity already exists (Report ID: #' . $report->id . ').'
                )->send();
            }
        }
    }
}
