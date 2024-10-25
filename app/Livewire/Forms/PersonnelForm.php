<?php

namespace App\Livewire\Forms;

use App\Models\Personnel;
use Illuminate\Validation\Rule;
use Livewire\Form;

class PersonnelForm extends Form
{
    public $personnel_id;
    public $department_id;
    public $position_id;
    public $office_id;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $gender;
    public $date_of_birth;
    public $phone_number;
    public $email;
    public $start_date;
    public $end_date;
    public $remarks;

    public function setPersonnel(Personnel $personnel)
    {
        $this->personnel_id = $personnel->id;
        $this->department_id = $personnel->department_id;
        $this->office_id = $personnel->office_id;
        $this->position_id = $personnel->position_id;
        $this->first_name = $personnel->first_name;
        $this->middle_name = $personnel->middle_name;
        $this->last_name = $personnel->last_name;
        $this->gender = $personnel->gender;
        $this->date_of_birth = $personnel->date_of_birth;
        $this->phone_number = $personnel->phone_number;
        $this->email = $personnel->email;
        $this->start_date = $personnel->start_date;
        $this->end_date = $personnel->end_date;
        $this->remarks = $personnel->remarks;
        $this->department_id = $personnel->department_id;
    }

    public function rules()
    {
        return [
            'department_id' => ['required', 'exists:departments,id'],
            'office_id' => ['required', 'exists:offices,id'],
            'position_id' => ['required', 'exists:positions,id'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'phone_number' => ['required', 'regex:/^09\d{9}$/'],
            'email' => ['required', 'email', Rule::unique('personnel')->ignore($this->personnel_id)],
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
