<?php

namespace App\Livewire\Equipments;

use App\Enum\EquipmentStatus;
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
        $this->officers = AccountingOfficer::all()
            ->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => $item->full_name
                ];
            })
            ->toArray();
        $this->persons = Personnel::all()
            ->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => $item->full_name
                ];
            })
            ->toArray();
        $this->units = Unit::values();
        $this->statuses = EquipmentStatus::values();
        $this->organizations = OrganizationUnit::all()
            ->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => $item->name
                ];
            })
            ->toArray();;
        $this->operating_units = OperatingUnitProject::all()
            ->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => $item->name
                ];
            })
            ->toArray();
        $this->funds = Fund::all()
            ->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => $item->name
                ];
            })
            ->toArray();
        $this->personalProtectiveEquipment = PersonalProtectiveEquipment::all()
            ->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => $item->name
                ];
            })
            ->toArray();
    }


    public function render()
    {
        $this->form->total_amount = (int) $this->form->quantity * (float) $this->form->unit_price;
        return view('livewire.equipments.create');
    }
}
