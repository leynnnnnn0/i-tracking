<?php

namespace App\Livewire\Forms;

use App\Enum\Gender;
use App\Enum\Position;
use App\Models\Personnel;
use Illuminate\Validation\Rule;
use Livewire\Form;

class PersonnelForm extends Form
{
    public $personnel_id;
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
    public $department_id = 1;

    public function setPersonnel(Personnel $personnel)
    {
        $this->first_name = $personnel->first_name;
        $this->middle_name = $personnel->middle_name;
        $this->last_name = $personnel->last_name;
        $this->gender = $personnel->gender;
        $this->date_of_birth = $personnel->date_of_birth;
        $this->phone_number = $personnel->phone_number;
        $this->email = $personnel->email;
        $this->position = $personnel->position;
        $this->start_date = $personnel->start_date;
        $this->end_date = $personnel->end_date;
        $this->remarks = $personnel->remarks;
        $this->department_id = $personnel->department_id;
    }

    public function rules()
    {
        return [
            'department_id' => ['required', 'exists:departments,id'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:' . implode(',', Gender::values())],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'phone_number' => ['required', 'regex:/^09\d{9}$/'],
            'email' => ['required', 'email', Rule::unique('personnels')->ignore($this->personnel_id)],
            'position' => ['required', 'in:' . implode(',', Position::values())],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after:start_date'],
            'remarks' => ['nullable', 'string'],
        ];
    }


    public function update(Personnel $personnel)
    {
        $this->personnel_id = $personnel->id;
        $personnel->update($this->all());
        return $personnel->fresh();
    }

    public function store()
    {
        return Personnel::create($this->all());
    }
}
