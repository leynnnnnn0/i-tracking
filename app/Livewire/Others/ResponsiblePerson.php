<?php

namespace App\Livewire\Others;

use App\Models\ResponsiblePerson as ModelsResponsiblePerson;
use Livewire\Component;

class ResponsiblePerson extends Component
{
    public $responsibles;

    public function mount()
    {
        $this->responsibles = ModelsResponsiblePerson::take(5)->get();
    }
    public function render()
    {
        return view('livewire.others.responsible-person');
    }
}
