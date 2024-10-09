<?php

namespace App\Livewire\Forms;

use App\Models\SupplyHistory;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SupplyHistoryForm extends Form
{
    public $supply_id;
    public $total_quantity;
    public $total_used;
    public $total_added;
    public $total;

    public function rules()
    {
        return [
            'supply_id' => ['required', 'exists:supplies,id'],
            'total_quantity' => ['required', 'integer', 'min:0'],
            'total_used' => ['required', 'integer', 'min:0'],
            'total_added' => ['required', 'integer', 'min:0'],
            'total' => ['required', 'integer', 'min:0'],
        ];
    }

    public function store()
    {
        $this->validate();
        return SupplyHistory::create($this->all());
    }
}
