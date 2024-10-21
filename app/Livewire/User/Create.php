<?php

namespace App\Livewire\User;

use App\Enum\Gender;
use App\Enum\UserRole;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\UserForm;
use App\Traits\Submittable;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    use Submittable;
    public UserForm $form;
    public ActivityLogForm $activityLogForm;
    public $genders;
    public $roles;

    protected function getModelName(): string
    {
        return 'user';
    }

    protected function performStoreOperation()
    {
        return $this->form->store();
    }

    public function mount()
    {
        $this->genders = Gender::values();
        $this->roles = UserRole::values();
    }
    public function render()
    {
        return view('livewire.user.create');
    }
}
