<?php

namespace App\Livewire\OperatingUnitProject;

use App\Models\OperatingUnitProject;
use Livewire\Component;

class View extends Component
{
    public $operatingUnit;

    public function mount($id)
    {
        $this->operatingUnit = OperatingUnitProject::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.operating-unit-project.view');
    }
}
