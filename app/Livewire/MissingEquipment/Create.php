<?php

namespace App\Livewire\MissingEquipment;

use App\Enum\EquipmentStatus;
use App\Enum\MissingStatus;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\MissingEquipmentForm;
use App\Models\Equipment;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public ActivityLogForm $activityLogForm;
    public MissingEquipmentForm $form;
    public $statuses;
    public $equipments;
    public $isCondemened = false;
    public $quantityHint = "";

    public function mount()
    {
        $this->form->reported_date = Carbon::today()->format('Y-m-d');
        $this->equipments = Equipment::select('id', 'name', 'property_number')
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
        if ($this->form->equipment_id) {
            $this->quantityHint = "Equipment quantity: " . Equipment::select('quantity')->find($this->form->equipment_id)->quantity;
        }
        return view('livewire.missing-equipment.create');
    }

    public function submit()
    {
        try {
            DB::transaction(function () {
                $data = $this->form->store();
                $this->activityLogForm->setActivityLog(null, $data, 'Created Missing Equipment Report', 'Create');
                $this->activityLogForm->store();
                if ($this->isCondemened) {
                    Equipment::findOrFail($data->equipment_id)->update([
                        'status' => EquipmentStatus::CONDEMNED->value
                    ]);;
                }
            });
            Toaster::success('Report Created.');
            return $this->redirect('/missing-equipments');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
            throw $e;
        }
    }
}
