<?php

namespace App\Livewire;

use App\Models\User as ModelsUser;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class User extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.user', [
            'users' => ModelsUser::latest()->paginate(10)
        ]);
    }

    public function delete($id): void
    {
        ModelsUser::findOrFail($id)->delete();
        Toaster::success('Successfully Deleted!');
        $this->dispatch('Data Deleted');
    }
}
