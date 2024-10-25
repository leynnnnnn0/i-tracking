<?php

namespace App\Livewire\Forms;

use App\Models\OperatingUnitProject;
use Livewire\Attributes\Validate;
use Livewire\Form;

class OperatingUnitProjectForm extends Form
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
        return OperatingUnitProject::create($this->all());
    }

    public function setOperatingUnitProjectForm(OperatingUnitProject $operatingUnitProject)
    {
        $this->name = $operatingUnitProject->name;
    }

    public function update(OperatingUnitProject $operatingUnitProject)
    {
        $operatingUnitProject->update($this->all());
        return $operatingUnitProject->fresh();
    }
}
