<?php

namespace App\Livewire\Equipments;

use App\Enum\EquipmentStatus;
use App\Enum\OperatingUnitAndProject;
use App\Enum\OrganizationUnit;
use App\Enum\Unit;
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
    public $previous_responsible_person;

    public $statuses;
    public $organizations;
    public $operating_units;
    public $units;


    public function mount($id)
    {
        $this->units = Unit::values();
        $this->statuses = EquipmentStatus::values();
        $this->organizations = OrganizationUnit::values();
        $this->operating_units = OperatingUnitAndProject::values();
        $this->persons = ResponsiblePerson::select('id', 'first_name', 'last_name')
            ->get()
            ->pluck('full_name', 'id');
        $this->equipment = Equipment::with('responsible_person')->findOrFail($id);
        $this->form->setEquipment($this->equipment);
    }

    public function render()
    {
        return view('livewire.equipments.edit');
    }

    public function update()
    {
        $this->previous_responsible_person = $this->equipment->responsible_person->full_name;
        try {
            DB::transaction(function () {
                $equipment = $this->form->update($this->equipment);
                $this->activityLogForm->setActivityLog($this->equipment, $equipment, 'Update Equipment', 'Update');
                $this->activityLogForm->store();
            });
            Toaster::success('Updated Successfully');
            return redirect()->route('responsible-person-pdf', [
                'equipment_id' => $this->equipment->id,
                'previous_responsible_person' => $this->previous_responsible_person
            ]);
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
