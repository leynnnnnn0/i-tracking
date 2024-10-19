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
    public $isCondemened = false;

    public function mount($id)
    {
        $this->report = MissingEquipment::findOrFail($id);
        $this->equipments = Equipment::pluck('name', 'id');
        $this->statuses = MissingStatus::values();
        $this->form->setMissingEquipmentForm($this->report);
    }


    public function render()
    {
        return view('livewire.missing-equipment.edit');
    }

    public function update()
    {
        $this->dispatch('Confirm Update');
        try {
            DB::transaction(function () {
                $data = $this->form->update($this->report);
                $this->activityLogForm->setActivityLog($this->report, $data, 'Updated Equipment Missing Report', 'Update');
                $this->activityLogForm->store();
                if ($this->isCondemened) {
                    Equipment::findOrFail($data->equipment_id)->update([
                        'status' => EquipmentStatus::CONDEMNED->value
                    ]);;
                }
            });
            Toaster::success('Updated Successfully.');
            $this->redirect('/missing-equipments');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
