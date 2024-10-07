<?php

namespace App\Livewire;

use App\Models\User as ModelsUser;
use Livewire\Component;
use Livewire\WithPagination;

class User extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.user', [
            'users' => ModelsUser::latest()->paginate(10)
        ]);
    }
}
