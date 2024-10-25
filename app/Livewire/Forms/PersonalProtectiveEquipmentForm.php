<?php

namespace App\Livewire\Forms;

use App\Models\PersonalProtectiveEquipment;
use Livewire\Form;

class PersonalProtectiveEquipmentForm extends Form
{
    public $name;

    public function rules()
    {
        return [
            'name' => ['required']
        ];
    }

    public function store()
    {
        return PersonalProtectiveEquipment::create($this->all());
    }

    public function setPersonalProtectiveEquipmentForm(PersonalProtectiveEquipment $equipment)
    {
        $this->name = $equipment->name;
    }

    public function update(PersonalProtectiveEquipment $equipment)
    {
        $equipment->update($this->all());
        return $equipment->fresh();
    }
}
