<?php

namespace App\Livewire\Personnel;

use App\Models\Personnel;
use Livewire\Component;

class View extends Component
{
    public $personnel;
    public function mount($id)
    {
        $this->personnel = Personnel::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.personnel.view');
    }
}
