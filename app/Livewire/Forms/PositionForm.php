<?php

namespace App\Livewire\Forms;

use App\Models\Position;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PositionForm extends Form
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
        return Position::create($this->all());
    }

    public function setOfficeForm(Position $position)
    {
        $this->name = $position->name;
    }

    public function update(Position $position)
    {
        $position->update($this->all());
        return $position->fresh();
    }
}
