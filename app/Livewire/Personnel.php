<?php

namespace App\Livewire;

use App\Enum\Gender;
use App\Models\Personnel as ModelsPersonnel;
use Livewire\Component;

class Personnel extends Component
{
    public function render()
    {
        return view('livewire.personnel', [
            'data' => ModelsPersonnel::latest()->paginate(10)
        ]);
    }
}
