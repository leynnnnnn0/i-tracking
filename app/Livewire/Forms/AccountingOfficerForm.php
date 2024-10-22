<?php

namespace App\Livewire\Forms;

use App\Models\AccountingOfficer;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AccountingOfficerForm extends Form
{
    public $office_id;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $email;
    public $phone_number;


    protected function rules()
    {
        return [
            'office_id' => ['required', 'integer', 'exists:offices,id'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone_number' => ['required', 'string', 'regex:/^09\d{9}$/'],
        ];
    }


    public function setForm(AccountingOfficer $officer)
    {
        $this->office_id = $officer->office_id;
        $this->first_name = $officer->first_name;
        $this->middle_name = $officer->middle_name;
        $this->last_name = $officer->last_name;
        $this->email = $officer->email;
        $this->phone_number = $officer->phone_number;
    }

    public function store()
    {
        return AccountingOfficer::create($this->all());
    }

    public function update(AccountingOfficer $accountingOfficer)
    {

        $accountingOfficer->update($this->all());
        return $accountingOfficer->fresh();
    }
}
