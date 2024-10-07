<?php

namespace App\Livewire\Forms;

use App\Livewire\BorrowedLog;
use App\Models\BorrowedEquipment;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
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

    public function rules()
    {
        return [
            'equipment_id' => ['required', 'exists:equipment,id'],
            'borrower_first_name' => ['required', 'string', 'max:255'],
            'borrower_last_name' => ['required', 'string', 'max:255'],
            'borrower_phone_number' => ['required', 'regex:/^09\d{9}$/'],
            'borrower_email' => ['required', 'email', 'max:255'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'is_returned' => ['boolean'],
        ];
    }

    public function store()
    {
        $this->validate();
        DB::transaction(function () {
            $borrowedItem = BorrowedEquipment::create($this->all());
            $borrowedItem->equipment()->update([
                'is_borrowed' => true
            ]);
        });
    }
}
