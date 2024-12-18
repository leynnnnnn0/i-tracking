<?php

namespace App\Livewire\Equipments;

use App\Enum\Unit;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\EquipmentForm;
use App\Models\AccountingOfficer;
use App\Models\Fund;
use App\Models\OperatingUnitProject;
use App\Models\OrganizationUnit;
use App\Models\PersonalProtectiveEquipment;
use App\Models\Personnel;
use App\Traits\Submittable;
use Livewire\Component;

class Create extends Component
{
    use Submittable;
    public ActivityLogForm $activityLogForm;
    public EquipmentForm $form;
    public $persons;
    public $statuses;
    public $organizations;
    public $operating_units;
    public $units;
    public $officers;
    public $personalProtectiveEquipment;
    public $funds;


    protected function getModelName(): string
    {
        return 'equipment';
    }

    protected function performStoreOperation()
    {
        return $this->form->store();
    }

    public function mount()
    {
        $this->units = Unit::values();

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
    }


    public function render()
    {
        $this->form->total_amount = (int) $this->form->quantity * (float) $this->form->unit_price;
        return view('livewire.equipments.create');
    }
}
