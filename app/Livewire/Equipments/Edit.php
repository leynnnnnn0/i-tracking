<?php

namespace App\Livewire\Equipments;

use App\Enum\EquipmentStatus;

use App\Enum\Unit;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\EquipmentForm;
use App\Models\AccountingOfficer;
use App\Models\Equipment;
use App\Models\Fund;
use App\Models\OperatingUnitProject;
use App\Models\OrganizationUnit;
use App\Models\PersonalProtectiveEquipment;
use App\Models\Personnel;
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

    public $officers;
    public $personalProtectiveEquipment;
    public $funds;




    public function mount($id)
    {
        $this->equipment = Equipment::with('personnel', 'accounting_officer')->findOrFail($id);


        $this->units = Unit::values();
        $this->statuses = EquipmentStatus::values();
        $this->officers = AccountingOfficer::toSelectOptions(
            label: 'full_name',
            columns: ['first_name', 'last_name', 'id']
        );
        $this->persons = Personnel::toSelectOptions(
            label: 'full_name',
            columns: ['first_name', 'last_name', 'id']
        );
        $this->organizations = OrganizationUnit::toSelectOptions();
        $this->operating_units = OperatingUnitProject::toSelectOptions();
        $this->funds = Fund::toSelectOptions();
        $this->personalProtectiveEquipment = PersonalProtectiveEquipment::toSelectOptions();

        $this->units = Unit::values();
        $this->statuses = EquipmentStatus::values();
        $this->equipment = Equipment::with('responsible_person')->findOrFail($id);
        $this->form->setEquipment($this->equipment);
    }



    public function render()
    {
        return view('livewire.equipments.edit');
    }

    public function update()
    {
        $this->dispatch('Confirm Update');
        $this->previous_responsible_person = $this->equipment->personnel->full_name;
        try {
            DB::transaction(function () {
                $this->form->update($this->equipment);
                $this->equipment = $this->equipment->fresh();
                $this->dispatch('Equipment Updated');
            });

            Toaster::success('Updated Successfully.');
            if ($this->previous_responsible_person !== $this->equipment->personnel->full_name) {
                $query = http_build_query([
                    'download_pdf' => true,
                    'equipment_id' => $this->equipment->id,
                    'previous_responsible_person' => $this->previous_responsible_person
                ]);
                return redirect()->to(route('equipment.index') . '?' . $query);
            } else {
                return $this->redirect('/equipment', true);
            }
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
            throw $e;
        }
    }
}
