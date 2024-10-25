<?php

namespace App\Livewire\PersonalProtectiveEquipment;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\OfficeForm;
use App\Livewire\Forms\PersonalProtectiveEquipmentForm;
use App\Traits\Submittable;
use Livewire\Component;

class Create extends Component
{
    use Submittable;
    public PersonalProtectiveEquipmentForm $form;
    public ActivityLogForm $activityLogForm;
    protected function performStoreOperation()
    {
        return $this->form->store();
    }

    protected function getModelName(): string
    {
        return 'personal protective equipment';
    }
    public function render()
    {
        return view('livewire.personal-protective-equipment.create');
    }
}
