<?php

namespace App\Livewire\Forms;

use App\Models\ResponsiblePerson;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ResponsiblePersonForm extends Form
{
    public $accounting_officer_id;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $email;
    public $phone_number;

    protected function rules()
    {
        return [
            'accounting_officer_id' => ['required', 'integer', 'exists:accounting_officers,id'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone_number' => ['required', 'string', 'regex:/^09\d{9}$/'],
        ];
    }

    public function setForm(ResponsiblePerson $officer)
    {
        $this->accounting_officer_id = $officer->accounting_officer_id;
        $this->first_name = $officer->first_name;
        $this->middle_name = $officer->middle_name;
        $this->last_name = $officer->last_name;
        $this->email = $officer->email;
        $this->phone_number = $officer->phone_number;
    }

    public function store()
    {

        return ResponsiblePerson::create($this->all());
    }

    public function update(ResponsiblePerson $responsiblePerson)
    {
        $responsiblePerson->update($this->all());
        return $responsiblePerson->fresh();
    }
}
