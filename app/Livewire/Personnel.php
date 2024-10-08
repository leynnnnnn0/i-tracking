<?php

namespace App\Livewire;

use App\Enum\Gender;
use App\Models\Personnel as ModelsPersonnel;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Personnel extends Component
{
    public function render()
    {
        return view('livewire.personnel', [
            'data' => ModelsPersonnel::latest()->paginate(10)
        ]);
    }


    public function delete($id): void
    {
        ModelsPersonnel::findOrFail($id)->delete();
        Toaster::success('Successfully Deleted!');
        $this->dispatch('Data Deleted');
    }
}
