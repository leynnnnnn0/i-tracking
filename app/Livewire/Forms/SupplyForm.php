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
    public $used = 0;
    public $recently_added = 0;
    public $total;

    public function rules()
    {
        return [
            'description' => ['required', 'string', 'min:2'],
            'unit' => ['required', Rule::in(Unit::values())],
            'quantity' => ['required', 'numeric'],
            'used' => ['sometimes', 'required'],
            'recently_added' => ['sometimes', 'nullable', 'required'],
            'expiry_date' => ['nullable', 'date'],
            'is_consumable' => ['required'],
            'category' => ['required', 'exists:categories,id'],
            'total' => ['sometimes', 'numeric']
        ];
    }

    public function store()
    {
        self::setRecentlyAdded();
        self::setTotal();
        $this->validate();
        Supply::create($this->all());
    }

    public function update(Supply $supply)
    {
        self::setQuantity();
        self::setTotal();
        $this->validate();
        $supply->update($this->all());
    }

    public function setSupply(Supply $supply)
    {
        $this->description = $supply->description;
        $this->unit = $supply->unit;
        $this->quantity = $supply->quantity;
        $this->category = 1;
        // $supply->categories->pluck('id')
        $this->expiry_date = $supply->expiry_date;
        $this->is_consumable = $supply->is_consumable;
        $this->used = $supply->used;
        $this->recently_added = $supply->recently_added;
    }

    public function setTotal()
    {
        $this->total = $this->quantity - $this->used;
    }

    public function setQuantity()
    {
        $this->quantity += $this->recently_added;
    }

    public function setRecentlyAdded()
    {
        $this->recently_added += $this->quantity;
    }
}
