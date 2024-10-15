<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class View extends Component
{
    public $user;
    public function mount($id)
    {
        $this->user = User::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.user.view');
    }
}
