<?php

namespace App\Livewire\Forms;

use App\Enum\BorrowStatus;
use App\Enum\EquipmentStatus;
use App\Models\BorrowedEquipment;
use App\Models\Equipment;
use Livewire\Form;

class BorrowEquipmentForm extends Form
{
    public $total_quantity_returned_copy;
    public $total_quantity_missing_copy;
    public $currentQuantity;
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
    public $quantity_returned = 0;
    public $quantity_missing = 0;
    public $total_quantity_returned = 0;
    public $total_quantity_missing = 0;

    public $status = 'borrowed';

    public function rules()
    {
        return [
            'equipment_id' => ['required', 'exists:equipment,id'],
            'quantity' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    $equipment = Equipment::find($this->equipment_id);
                    if (!$equipment) {
                        $fail("Unable to verify equipment quantity. Please ensure a valid equipment is selected.");
                        return;
                    }

                    $availableQuantity = $equipment->quantity - $equipment->quantity_borrowed;
                    if ($this->currentQuantity) {
                        $availableQuantity += $this->currentQuantity;
                    }

                    if ($value > $availableQuantity) {
                        $fail("The {$attribute} must not exceed the available quantity of {$availableQuantity}.");
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
            'status' => ['required'],
            'quantity_returned' => ['nullable', 'min:0'],
            'quantity_missing' => ['nullable', 'min:0']
        ];
    }

    public function setBorrowEquipment(BorrowedEquipment $borrowedEquipment)
    {
        $this->currentQuantity = $borrowedEquipment->quantity;
        $this->equipment_id = $borrowedEquipment->equipment_id;
        $this->quantity = $borrowedEquipment->quantity;
        $this->borrower_first_name = $borrowedEquipment->borrower_first_name;
        $this->borrower_last_name = $borrowedEquipment->borrower_last_name;
        $this->borrower_phone_number = $borrowedEquipment->borrower_phone_number;
        $this->borrower_email = $borrowedEquipment->borrower_email;
        $this->start_date = $borrowedEquipment->start_date->format('Y-m-d');
        $this->end_date = $borrowedEquipment->end_date->format('Y-m-d');
        $this->returned_date = $borrowedEquipment->returned_date;
        $this->is_returned = $borrowedEquipment->is_returned;
        $this->status = $borrowedEquipment->status;
        $this->total_quantity_missing = $borrowedEquipment->total_quantity_missing;
        $this->total_quantity_returned = $borrowedEquipment->total_quantity_returned;
        $this->total_quantity_missing = $borrowedEquipment->total_quantity_missing;
        $this->total_quantity_returned = $borrowedEquipment->total_quantity_returned;
        $this->total_quantity_returned_copy = $borrowedEquipment->total_quantity_returned;
        $this->total_quantity_missing_copy = $borrowedEquipment->total_quantity_missing;
    }


    public function store()
    {
        $borrowedEquipment = BorrowedEquipment::create($this->all());
        $this->updateEquipmentStatus($borrowedEquipment);
        return $borrowedEquipment->fresh();
    }

    public function updateEquipmentStatus(BorrowedEquipment $borrowedEquipment)
    {
        $equipment = $borrowedEquipment->equipment;
        if ($this->status === 'partially_returned') {
            $totalBorrowedQuantity = $equipment->quantity_borrowed - $this->quantity_returned;

            $totalAvailableQuantity = $equipment->quantity_available + $this->quantity_returned;
            $equipment->update([
                'quantity_borrowed' => $totalBorrowedQuantity,
                'quantity_available' => $totalAvailableQuantity
            ]);
        } else if ($this->status === 'returned') {
            $totalBorrowedQuantity = $equipment->quantity_borrowed - ($this->quantity - $this->total_quantity_returned_copy);

            $totalAvailableQuantity = $equipment->quantity_available + ($this->quantity - $this->total_quantity_returned_copy);


            $status = EquipmentStatus::ACTIVE->value;
            if ($totalBorrowedQuantity > 0)
                $status = EquipmentStatus::PARTIALLY_BORROWED->value;

            $equipment->update([
                'quantity_borrowed' => $totalBorrowedQuantity,
                'quantity_available' => $totalAvailableQuantity,
                'status' => $status
            ]);
        } else if ($this->status === BorrowStatus::PARTIALLY_MISSING->value) {
            // Add the qunatity missing to equipment quantiy missing 
            $totalMissingQuantity  = $equipment->quantity_missing + $this->quantity_missing;
            $totalBorrowedQuantity = $equipment->quantity_borrowed - $this->quantity_missing;
            $equipment->update([
                'quantity_missing' => $totalMissingQuantity,
                'quantity_borrowed' => $totalBorrowedQuantity
            ]);
        } else if ($this->status === BorrowStatus::MISSING->value) {
            // Total quantity missing of the equioment will be current missing + quantiy of borrowed equipment 
            $totalMissingQuantity = $equipment->quantity_missing + ($this->quantity - $this->total_quantity_missing_copy);
            $totalBorrowedQuantity = $equipment->quantity_borrowed - ($this->quantity - $this->total_quantity_missing_copy);

            $status = EquipmentStatus::ACTIVE->value;
            if ($totalBorrowedQuantity > 0)
                $status = EquipmentStatus::PARTIALLY_BORROWED->value;
            $equipment->update([
                'quantity_borrowed' => $totalBorrowedQuantity,
                'quantity_missing' => $totalMissingQuantity,
                'status' => $status
            ]);
        } else if ($this->status === BorrowStatus::RETURNED_WITH_MISSING->value) {
            $totalBorrowedQuantity = $equipment->quantity_borrowed - ($this->quantity_missing + $this->quantity_returned);
            $totalAvailableQuantity = $equipment->quantity_available + $this->quantity_returned;
            $totalMissingQuantity = $equipment->quantity_missing + $this->quantity_missing;


            $status = EquipmentStatus::ACTIVE->value;
            if ($totalBorrowedQuantity > 0)
                $status = EquipmentStatus::PARTIALLY_BORROWED->value;
            $equipment->update([
                'quantity_borrowed' => $totalBorrowedQuantity,
                'quantity_available' => $totalAvailableQuantity,
                'quantity_missing' => $totalMissingQuantity,
                'status' => $status
            ]);
        } else {
            $totalBorrowedQuantity = $equipment->quantity_borrowed - $this->currentQuantity + $borrowedEquipment->quantity;
            $equipmentAvailableQuantity = $equipment->quantity - $totalBorrowedQuantity;
            if ($totalBorrowedQuantity === $equipment->quantity) {
                $equipment->update([
                    'quantity_borrowed' => $totalBorrowedQuantity,
                    'quantity_available' => $equipmentAvailableQuantity,
                    'status' => EquipmentStatus::FULLY_BORROWED->value
                ]);
            } else {
                $equipment->update([
                    'quantity_borrowed' => $totalBorrowedQuantity,
                    'quantity_available' => $equipmentAvailableQuantity,
                    'status' => EquipmentStatus::PARTIALLY_BORROWED->value
                ]);
            }
        }
        // Checking if the borrowed equipment log status is already returned
        // if ($borrowedEquipment->returned_date) {
        //     $quantityBorrowed = $equipment->quantity_borrowed - $borrowedEquipment->quantity;
        //     $equipmentAvailableQuantity = $equipment->quantity_available + $borrowedEquipment->quantity;
        //     $status = EquipmentStatus::ACTIVE->value;
        //     if ($quantityBorrowed > 0) {
        //         $status = EquipmentStatus::PARTIALLY_BORROWED->value;
        //     }
        //     $equipment->update([
        //         'quantity_borrowed' => $quantityBorrowed,
        //         'quantity_available' => $equipmentAvailableQuantity,
        //         'status' => $status
        //     ]);
        // } 
    }

    public function update(BorrowedEquipment $borrowedEquipment)
    {
        $borrowedEquipment->update($this->all());
        $this->updateEquipmentStatus($borrowedEquipment);
        return $borrowedEquipment;
    }
}
