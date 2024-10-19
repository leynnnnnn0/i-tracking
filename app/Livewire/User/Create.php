<?php

namespace App\Livewire\User;

use App\Enum\Gender;
use App\Enum\UserRole;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\UserForm;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public UserForm $form;
    public ActivityLogForm $activityLogForm;
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
        try {
            DB::transaction(function () {
                $user = $this->form->store();
                $this->activityLogForm->setActivityLog(null, $user, 'Create user', 'Create');
                $this->activityLogForm->store();
            });
            Toaster::success('New User Created');
            return $this->redirect('/users');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
            throw $e;
        }
    }
}
