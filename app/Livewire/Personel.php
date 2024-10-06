<?php

namespace App\Livewire;

use App\Models\Personnel;
use Livewire\Component;
use Livewire\WithPagination;

class Personel extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.personel', [
            'data' => Personnel::with('department')->latest()->paginate(10)
        ]);
    }
}
