<?php

namespace App\Livewire\Forms;

use App\Models\Equipment;
use Illuminate\Validation\Rule;
use Livewire\Form;

class EquipmentForm extends Form
{
    public $equipment_id;
    public $responsible_person_id;
    public $uid;
    public $name;
    public $is_borrowed = false;

    public function rules()
    {
        return [
            'uid' => ['required', Rule::unique('equipment')->ignore($this->equipment_id)],
            'responsible_person_id' => ['required', 'exists:responsible_people,id'],
            'name' => ['required', 'min:2'],
            'is_borrowed' => ['required']
        ];
    }
    public function setEquipment(Equipment $equipment)
    {
        $this->uid = $equipment->uid;
        $this->name = $equipment->name;
        $this->responsible_person_id = $equipment->responsible_person_id;
        $this->is_borrowed = $equipment->is_borrowed;
    }

    public function store()
    {
        $this->validate();
        Equipment::create($this->all());
    }

    public function update(Equipment $equipment)
    {
        $this->equipment_id = $equipment->id;
        $this->validate();
        $equipment->update($this->all());
        return $equipment->fresh();
    }
}
