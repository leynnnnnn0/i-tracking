<?php

namespace App\Livewire\Forms;

use App\Models\BorrowedEquipment;
use App\Models\Equipment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Form;

class BorrowEquipmentForm extends Form
{
    public $equipment_id;
    public $borrower_first_name;
    public $borrower_last_name;
    public $borrower_phone_number;
    public $borrower_email;
    public $start_date;
    public $end_date;
    public $is_returned = false;
    public $quantity;
    public $returned_date;

    public function rules()
    {
        return [
            'equipment_id' => ['required', 'exists:equipment,id'],
            'quantity' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    $equipment = Equipment::with(['borrowed_log' => function ($query) {
                        $query->whereNull('returned_date');
                    }])->find($this->equipment_id);

                    if ($equipment) {
                        $borrowedQuantity = $equipment->borrowed_log->sum('quantity');
                        $availableQuantity = $equipment->quantity - $borrowedQuantity;

                        if ($value > $availableQuantity) {
                            $fail("The {$attribute} must not exceed the available quantity of {$availableQuantity}.");
                        }
                    } else {
                        $fail("Unable to verify equipment quantity. Please ensure a valid equipment is selected.");
                    }
                },
            ],
            'borrower_first_name' => ['required', 'string', 'max:255'],
            'borrower_last_name' => ['required', 'string', 'max:255'],
            'borrower_phone_number' => ['required', 'regex:/^09\d{9}$/'],
            'borrower_email' => ['required', 'email', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'is_returned' => ['boolean'],
        ];
    }

    public function setBorrowEquipment(BorrowedEquipment $borrowedEquipment)
    {
        $this->equipment_id = $borrowedEquipment->equipment_id;
        $this->quantity = $borrowedEquipment->quantity;
        $this->borrower_first_name = $borrowedEquipment->borrower_first_name;
        $this->borrower_last_name = $borrowedEquipment->borrower_last_name;
        $this->borrower_phone_number = $borrowedEquipment->borrower_phone_number;
        $this->borrower_email = $borrowedEquipment->borrower_email;
        $this->start_date = $borrowedEquipment->start_date->format('Y-m-d');
        $this->end_date = $borrowedEquipment->end_date->format('Y-m-d');
        $this->is_returned = $borrowedEquipment->is_returned;
    }


    public function store()
    {
        $equipment = BorrowedEquipment::create($this->all());
        $this->reset();
        return $equipment;
    }

    public function update(BorrowedEquipment $borrowedEquipment)
    {
        $borrowedEquipment->update($this->all());
        return $borrowedEquipment->fresh();
    }

    public function returned() {}
}
