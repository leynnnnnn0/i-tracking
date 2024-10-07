<?php

namespace App\Livewire\Forms;

use App\Models\Equipment;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EquipmentForm extends Form
{
    public $responsible_person_id;
    public $uid;
    public $name;
    public $is_borrowed = false;

    public function rules()
    {
        return [
            'uid' => ['required', 'unique:equipment,uid'],
            'responsible_person_id' => ['required', 'exists:responsible_people,id'],
            'name' => ['required', 'min:2'],
            'is_borrowed' => ['required']
        ];
    }

    public function store()
    {
        $this->validate();
        Equipment::create($this->all());
    }
}
