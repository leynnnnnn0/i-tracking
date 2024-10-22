<?php

namespace App\Livewire\Forms;

use App\Enum\Gender;
use App\Enum\UserRole;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Form;
use Illuminate\Support\Str;

class UserForm extends Form
{
    public $user_id;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $gender;
    public $date_of_birth;
    public $phone_number;
    public $email;
    public $password;
    public $role;

    public function setUserForm(User $user)
    {
        $this->first_name = $user->first_name;
        $this->middle_name = $user->middle_name;
        $this->last_name = $user->last_name;
        $this->gender = $user->gender;
        $this->date_of_birth = $user->date_of_birth;
        $this->phone_number = $user->phone_number;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->password = $user->password;
    }

    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:Male,Female'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'phone_number' => ['required', 'string', 'regex:/^09\d{9}$/'],
            'email' => ['required', 'email', 'max:255',  Rule::unique('users')->ignore($this->user_id)],
            'password' => ['sometimes','required', 'string', 'min:8'],
            'role' => ['required', 'string', Rule::in(UserRole::values())]
        ];
    }
    public function store()
    {
        return User::create($this->all());
    }

    public function update(User $user)
    {
        $this->user_id = $user->id;
        $user->update($this->except('password'));
        return $user->fresh();
    }
}
