<?php

namespace App\Livewire\User;

use App\Enum\Gender;
use App\Enum\UserRole;
use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    public UserForm $form;
    public $user;
    public $genders;
    public $roles;

    public function mount($id)
    {
        $this->genders = Gender::values();
        $this->roles = UserRole::values();
        $this->user = User::findOrFail($id);
        $this->form->setUserForm($this->user);
    }

    public function render()
    {
        return view('livewire.user.edit');
    }

    public function edit()
    {
        $this->form->update($this->user);
        Toaster::success('Updated Successfully!');
        return $this->redirect('/users');
    }
}
