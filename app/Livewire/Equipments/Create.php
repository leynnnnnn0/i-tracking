<?php

namespace App\Livewire\Equipments;

use App\Enum\EquipmentStatus;
use App\Enum\OperatingUnitAndProject;
use App\Enum\OrganizationUnit;
use App\Enum\Unit;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\EquipmentForm;
use App\Models\AccountingOfficer;
use App\Models\ResponsiblePerson;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public ActivityLogForm $activityLogForm;
    public EquipmentForm $form;
    public $persons;
    public $statuses;
    public $organizations;
    public $operating_units;
    public $units;
    #[Validate('required')]
    public $officers;
    public $officer;

    public function mount()
    {
        $this->officers = AccountingOfficer::all()
            ->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => $item->full_name
                ];
            })
            ->toArray();
        $this->units = Unit::values();
        $this->statuses = EquipmentStatus::values();
        $this->organizations = OrganizationUnit::values();
        $this->operating_units = OperatingUnitAndProject::values();
        $this->updatePersons();
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'officer') {
            $this->updatePersons();
            $this->form->responsible_person_id = null; // Reset the selected person
        }
    }

    public function updatePersons()
    {
        $this->persons = ResponsiblePerson::where('accounting_officer_id', $this->officer)
            ->get()
            ->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => $item->full_name
                ];
            })
            ->toArray();
    }

    public function submit()
    {
        try {
            DB::transaction(function () {
                $equipment = $this->form->store();
                $this->activityLogForm->setActivityLog(null, $equipment, 'Create Equipment', 'Create');
                $this->activityLogForm->store();
            });
            Toaster::success('New Equipment Created!');
            return $this->redirect('/equipments');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
            throw $e;
        }
    }
    public function render()
    {
        $this->form->total_amount = (int) $this->form->quantity * (float) $this->form->unit_price;
        return view('livewire.equipments.create');
    }
}
