<?php

namespace App\Livewire\MissingEquipment;

use App\Enum\MissingStatus;
use App\Livewire\Forms\MissingEquipmentForm;
use App\Models\Equipment;
use App\Models\MissingEquipment;
use Livewire\Component;

class Edit extends Component
{
    public $equipments;
    public $statuses;
    public MissingEquipmentForm $form;
    public $report;

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

    public function edit()
    {
        $this->form->update($this->report);
    }
}
