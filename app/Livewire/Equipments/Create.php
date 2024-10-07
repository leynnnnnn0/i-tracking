<?php

namespace App\Livewire\Equipments;

use App\Livewire\Forms\EquipmentForm;
use App\Models\ResponsiblePerson;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

use function Laravel\Prompts\select;

class Create extends Component
{
    public EquipmentForm $form;
    public $persons;

    public function mount()
    {
        $this->persons = ResponsiblePerson::select('id', 'first_name', 'last_name')
            ->get()
            ->pluck('full_name', 'id');
    }

    public function submit()
    {
        $this->form->store();
        Toaster::success('New Equipment Created!');
        return $this->redirect('/equipments');
    }
    public function render()
    {
        return view('livewire.equipments.create');
    }
}
