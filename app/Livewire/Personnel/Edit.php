<?php

namespace App\Livewire\Personnel;

use App\Enum\Gender;
use App\Enum\Position;
use App\Livewire\Forms\PersonnelForm;
use App\Models\Department;
use App\Models\Personnel;
use Livewire\Component;

class Edit extends Component
{
    public PersonnelForm $form;
    public $genders;
    public $positions;
    public $departments;

    public function mount($id)
    {
        $this->genders = Gender::values();
        $this->positions = Position::values();
        $this->departments = Department::pluck('name', 'id')->toArray();
        $personnel = Personnel::findOrFail($id);
        $this->form->setPersonnel($personnel);
    }
    public function render()
    {
        return view('livewire.personnel.edit');
    }
}
