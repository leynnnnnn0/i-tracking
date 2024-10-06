<?php

namespace App\Livewire\Forms;

use App\Enum\Gender;
use App\Enum\Position;
use App\Models\Personnel;
use Illuminate\Validation\Rule;
use Livewire\Form;

class PersonnelForm extends Form
{
    public $first_name;
    public $middle_name;
    public $last_name;
    public $gender;
    public $date_of_birth;
    public $phone_number;
    public $email;
    public $position;
    public $start_date;
    public $end_date;
    public $remarks;
    public $department_id;

    public function rules()
    {
        return [
            'department_id' => ['required', 'exists:departments,id'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:Male,Female'],
            'date_of_birth' => ['required', 'date'],
            'phone_number' => ['required', 'regex:/^09\d{9}$/'],
            'email' => ['required', 'email', 'unique:personnels,email'],
            'position' => ['required', 'in:' . implode(',', Position::values())],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
            'remarks' => ['nullable', 'string'],
        ];
    }

    public function store()
    {
        $this->validate();
        Personnel::create($this->all());
    }

}
