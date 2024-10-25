<?php

namespace App\Livewire\Forms;

use App\Models\OrganizationUnit;
use Livewire\Form;

class OrganizationUnitForm extends Form
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
        return OrganizationUnit::create($this->all());
    }

    public function setOrganizationUnitForm(OrganizationUnit $organizationUnit)
    {
        $this->name = $organizationUnit->name;
    }

    public function update(OrganizationUnit $organizationUnit)
    {
        $organizationUnit->update($this->all());
        return $organizationUnit->fresh();
    }
}
