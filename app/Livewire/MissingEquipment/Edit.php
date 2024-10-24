<?php

namespace App\Livewire\MissingEquipment;

use App\Enum\EquipmentStatus;
use App\Enum\MissingStatus;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\MissingEquipmentForm;
use App\Models\Equipment;
use App\Models\MissingEquipment;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    public $equipments;
    public $statuses;
    public MissingEquipmentForm $form;
    public ActivityLogForm $activityLogForm;
    public $report;
    public $quantityHint;

    public function mount($id)
    {
        $this->report = MissingEquipment::findOrFail($id);
        $this->equipments = Equipment::pluck('name', 'id');
        $this->statuses = MissingStatus::values();
        $this->form->setMissingEquipmentForm($this->report);
    }


    public function render()
    {
        $this->quantityHint = "Equipment quantity: " . Equipment::select('quantity')->find($this->form->equipment_id)->quantity;
        return view('livewire.missing-equipment.edit');
    }

    public function update()
    {
        $this->dispatch('Confirm Update');
        $this->form->validate();
        try {
            DB::transaction(function () {
                $data = $this->form->update($this->report);
                $this->activityLogForm->setActivityLog($this->report, $data, 'Updated Equipment Missing Report', 'Update');
                $this->activityLogForm->store();
                if ($this->form->is_condemned) {
                    $this->form->condemned($data->equipment_id);
                }
            });
            Toaster::success('Updated Successfully.');
            $this->redirect('/missing-equipment', true);
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
