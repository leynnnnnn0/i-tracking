<?php

namespace App\Livewire\Personnel;

use App\Enum\Gender;
use App\Enum\Position;
use App\Livewire\Forms\PersonnelForm;
use App\Models\Department;
use Livewire\Component;
use Masmerise\Toaster\Toast;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public PersonnelForm $form;
    public $genders;
    public $positions;
    public $departments;

    public function mount()
    {
        $this->genders = Gender::values();
        $this->positions = Position::values();
        $this->departments = Department::pluck('name', 'id')->toArray();
    }

    public function submit()
    {
        $this->form->store();
        Toaster::success('New Personnel Created!');
        return $this->redirect('/personnels');
    }
    public function render()
    {
        return view('livewire.personnel.create');
    }
}
