<?php

namespace App\Livewire\User;

use App\Enum\Gender;
use App\Enum\UserRole;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\UserForm;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    public ActivityLogForm $activityLogForm;
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
        try {
            DB::transaction(function () {
                $user = $this->form->update($this->user);
                $this->activityLogForm->setActivityLog($this->user, $user, 'Update User', 'Update');
                $this->activityLogForm->store();
            });
            Toaster::success('Updated Successfully!');
            return $this->redirect('/users');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
