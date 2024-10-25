<?php

namespace App\Livewire\Forms;

use App\Models\Fund;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FundForm extends Form
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
        return Fund::create($this->all());
    }

    public function setFundForm(Fund $fund)
    {
        $this->name = $fund->name;
    }

    public function update(Fund $fund)
    {
        $fund->update($this->all());
        return $fund->fresh();
    }
}
