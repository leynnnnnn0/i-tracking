<?php

namespace App\Livewire\Equipments;

use App\Enum\EquipmentStatus;
use App\Enum\OperatingUnitAndProject;
use App\Enum\OrganizationUnit;
use App\Enum\Unit;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\EquipmentForm;
use App\Models\ResponsiblePerson;
use Exception;
use Illuminate\Support\Facades\DB;
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

    public function mount()
    {
        $this->units = Unit::values();
        $this->statuses = EquipmentStatus::values();
        $this->organizations = OrganizationUnit::values();
        $this->operating_units = OperatingUnitAndProject::values();
        $this->persons = ResponsiblePerson::select('id', 'first_name', 'last_name')
            ->get()
            ->pluck('full_name', 'id');
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
