<?php

namespace App\Livewire\Forms;

use App\Enum\Gender;
use App\Enum\UserRole;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Form;

class UserForm extends Form
{
    public $first_name;
    public $middle_name;
    public $last_name;
    public $gender;
    public $date_of_birth;
    public $phone_number;
    public $email;
    public $password;
    public $role;

    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:Male,Female'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'phone_number' => ['required', 'string', 'regex:/^09\d{9}$/'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', Rule::in(UserRole::values())]
        ];
    }
    public function store()
    {
        $this->validate();
        User::create($this->all());
    }
}
