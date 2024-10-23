<?php

namespace App\Livewire\Forms;

use App\Models\Department;
use Livewire\Form;

class DepartmentForm extends Form
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
        return Department::create($this->all());
    }

    public function setOfficeForm(Department $department)
    {
        $this->name = $department->name;
    }

    public function update(Department $department)
    {
        $department->update($this->all());
        return $department->fresh();
    }
}
