<?php

namespace App\Livewire\User;

use App\Enum\Gender;
use App\Enum\UserRole;
use App\Livewire\Forms\UserForm;
use App\Models\User;
use App\Traits\Updatable;
use Livewire\Component;

class Edit extends Component
{
    use Updatable;
    public UserForm $form;
    public $user;
    public $genders;
    public $roles;
    public $newPassword;

    protected function afterTransaction($model)
    {
        if ($this->newPassword) {
            $model->update([
                'password' => $this->newPassword
            ]);
        }
    }

    protected function getRedirectRoute(): string
    {
        return 'users';
    }

    protected function getEloquentModel()
    {
        return $this->form->update($this->user);
    }

    public function rules()
    {
        return [
            'newPassword' => ['sometimes', 'required', 'min:8']
        ];
    }

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
}
