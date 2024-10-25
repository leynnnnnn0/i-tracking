<?php

namespace App\Livewire\MissingEquipment;

use App\Enum\MissingStatus;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\MissingEquipmentForm;
use App\Models\Equipment;
use App\Models\MissingEquipment;
use App\Traits\Updatable;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    use Updatable;
    public $equipments;
    public $statuses;
    public MissingEquipmentForm $form;
    public ActivityLogForm $activityLogForm;
    public $report;
    public $quantityHint;

    protected function afterTransaction($model)
    {
        if ($this->form->is_condemned) {
            $this->form->condemned($model->equipment_id);
        }
    }

    protected function getRedirectRoute(): string
    {
        return 'missing-equipment';
    }

    protected function getEloquentModel()
    {
        return $this->form->update($this->report);
    }

    public function mount($id)
    {
        $this->report = MissingEquipment::findOrFail($id);
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
        $this->form->setMissingEquipmentForm($this->report);
    }


    public function render()
    {
        $this->quantityHint = "Equipment quantity: " . Equipment::select('quantity')->find($this->form->equipment_id)->quantity;
        return view('livewire.missing-equipment.edit');
    }
}
