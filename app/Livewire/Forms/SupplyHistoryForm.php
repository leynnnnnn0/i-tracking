<?php

namespace App\Livewire\Forms;

use App\Models\Supply;
use App\Models\SupplyHistory;
use Livewire\Form;

class SupplyHistoryForm extends Form
{
    public $supply_id;
    public $quantity;
    public $used;
    public $added;
    public $total;

    public function rules()
    {
        return [
            'supply_id' => ['required', 'exists:supplies,id'],
            'quantity' => ['required', 'integer', 'min:0'],
            'used' => ['required', 'integer', 'min:0'],
            'added' => ['required', 'integer', 'min:0'],
            'total' => ['required', 'integer', 'min:0'],
        ];
    }

    public function setSupplyHistoryForm(Supply $supply)
    {
        $this->supply_id = $supply->id;
        $this->quantity = $supply->quantity;
        $this->used = $supply->used;
        $this->added = $supply->recently_added;
        $this->total = $supply->total;
    }

    public function store()
    {
        return SupplyHistory::create($this->all());
    }

}
