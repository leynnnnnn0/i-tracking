<?php

namespace App\Livewire\Forms;

use App\Models\Office;
use Livewire\Attributes\Validate;
use Livewire\Form;

class OfficeForm extends Form
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
        $this->validate();
        return Office::create($this->all());
    }

    public function setOfficeForm(Office $office)
    {
        $this->name = $office->name;
    }

    public function update(Office $office)
    {
        $this->validate();
        $office->update($this->all());
        return $office->fresh();
    }
}
