<?php

namespace App\Livewire\Forms;

use App\Enum\Unit;
use App\Models\Supply;
use Illuminate\Validation\Rule;
use Livewire\Form;

class SupplyForm extends Form
{
    public $description;
    public $unit;
    public $quantity;
    public $category;
    public $expiry_date;
    public $is_consumable;

    public function rules()
    {
        return [
            'description' => ['required', 'string', 'min:2'],
            'unit' => ['required', Rule::in(Unit::values())],
            'quantity' => ['nullable', 'numeric'],
            'category' => ['required', 'exists:categories,id'],
            'expiry_date' => ['nullable', 'date'],
            'is_consumable' => ['required']
        ];
    }

    public function store()
    {
        $this->validate();
        Supply::create($this->all());
    }

    public function setSupply(Supply $supply)
    {
        $this->description = $supply->description;
        $this->unit = $supply->unit;
        $this->quantity = $supply->quantity;
        $this->category = $supply->categories->pluck('id');
        $this->expiry_date = $supply->expiry_date;
        $this->is_consumable = $supply->is_consumable;
    }
}
