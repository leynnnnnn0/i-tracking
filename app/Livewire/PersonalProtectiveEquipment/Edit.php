<?php

namespace App\Livewire\PersonalProtectiveEquipment;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\PersonalProtectiveEquipmentForm;
use App\Models\PersonalProtectiveEquipment;
use App\Traits\Updatable;
use Livewire\Component;

class Edit extends Component
{
    use Updatable;
    public $equipment;
    public PersonalProtectiveEquipmentForm $form;
    public ActivityLogForm $activityLogForm;

    protected function getEloquentModel()
    {
        return $this->equipment;
    }

    protected function getRedirectRoute(): string
    {
        return'personal-protective-equipment';
    }

    public function mount($id)
    {
        $this->equipment = PersonalProtectiveEquipment::findOrFail($id);
        $this->form->setPersonalProtectiveEquipmentForm($this->equipment);
    }

    public function render()
    {
        return view('livewire.personal-protective-equipment.edit');
    }
}
