<?php

namespace App\Livewire\ResponsiblePerson;

use App\Models\ResponsiblePerson;
use Livewire\Component;

class View extends Component
{
    public $person;

    public function mount($id)
    {
        $this->person = ResponsiblePerson::with('accounting_officer')->findOrFail($id);
    }
    public function render()
    {
        return view('livewire.responsible-person.view');
    }
}
