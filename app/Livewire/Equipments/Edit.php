<?php

namespace App\Livewire\Equipments;

use App\Livewire\Forms\EquipmentForm;
use App\Models\Equipment;
use App\Models\ResponsiblePerson;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    public EquipmentForm $form;

    public $persons;
    public Equipment $equipment;

    public function mount($id)
    {
        $this->persons = ResponsiblePerson::select('id', 'first_name', 'last_name')
            ->get()
            ->pluck('full_name', 'id');
        $this->equipment = Equipment::findOrFail($id);
        $this->form->setEquipment($this->equipment);
    }

    public function render()
    {
        return view('livewire.equipments.edit');
    }

    public function update()
    {
        $this->form->update($this->equipment);
        Toaster::success('Updated Successfully!');
        return $this->redirect('/equipments');
    }
}
