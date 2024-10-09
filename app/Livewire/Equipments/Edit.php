<?php

namespace App\Livewire\Equipments;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\EquipmentForm;
use App\Livewire\Forms\MissingEquipmentForm;
use App\Models\Equipment;
use App\Models\ResponsiblePerson;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    public EquipmentForm $form;
    public ActivityLogForm $activityLogForm;

    public $persons;
    public Equipment $equipment;

    public function mount($id)
    {
        $this->persons = ResponsiblePerson::select('id', 'first_name', 'last_name')
            ->get()
            ->pluck('full_name', 'id');
        $this->equipment = Equipment::findOrFail($id);
        $this->form->setEquipment($this->equipment);
    }

    public function render()
    {
        return view('livewire.equipments.edit');
    }

    public function update()
    {
        try {
            DB::transaction(function () {
                $equipment = $this->form->update($this->equipment);
                $this->activityLogForm->setActivityLog($this->equipment, $equipment, 'Update Equipment', 'Update');
                $this->activityLogForm->store();
            });
            Toaster::success('Updated Successfully!');
            return $this->redirect('/equipments');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
