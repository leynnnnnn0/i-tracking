<?php

namespace App\Livewire\User;

use App\Enum\Gender;
use App\Enum\UserRole;
use App\Livewire\Forms\UserForm;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public UserForm $form;
    public $genders;
    public $roles;

    public function mount()
    {
        $this->genders = Gender::values();
        $this->roles = UserRole::values();
    }
    public function render()
    {
        return view('livewire.user.create');
    }

    public function submit()
    {
        $this->form->store();
        Toaster::success('New User Created');
        return $this->redirect('/users');
    }
}
