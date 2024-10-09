<?php

namespace App\Livewire\Forms;

use App\Models\MissingEquipment;
use Carbon\Carbon;
use Livewire\Form;

class MissingEquipmentForm extends Form
{

    public $equipment_id;
    public $status = 'lost';
    public $description;
    public $reported_by;
    public $reported_date;

    public function setMissingEquipmentForm(MissingEquipment $missingEquipment)
    { 
        $this->equipment_id = $missingEquipment->equipment_id;
        $this->status = $missingEquipment->status;
        $this->description = $missingEquipment->description;
        $this->reported_by = $missingEquipment->reported_by;
        $this->reported_date = $missingEquipment->reported_date->format('Y-m-d');
    }
    public function rules()
    {
        return [
            'equipment_id' => ['required', 'exists:equipment,id'],
            'status' => ['required', 'string', 'in:found,lost,under_investigation,presumed_lost,condemned '],
            'description' => ['nullable', 'string', 'max:255'],
            'reported_by' => ['required', 'string', 'max:100'],
            'reported_date' => ['required', 'date'],
        ];
    }

    public function store()
    {
        $this->validate();
        MissingEquipment::create($this->all());
    }

    public function update(MissingEquipmentForm $missingEquipmentForm)
    {
        $this->validate();

        $missingEquipmentForm->update($missingEquipmentForm);
    }
}
