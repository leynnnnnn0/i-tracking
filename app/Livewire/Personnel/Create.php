<?php

namespace App\Livewire\Personnel;

use App\Enum\Gender;
use App\Enum\Position;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\PersonnelForm;
use App\Models\Department;
use App\Traits\Submittable;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    use Submittable;
    public PersonnelForm $form;
    public ActivityLogForm $activityLogForm;
    public $genders;
    public $positions;
    public $departments;

    protected function getModelName(): string
    {
        return 'personnel';
    }

    protected function performStoreOperation()
    {
        return $this->form->store();
    }

    public function mount()
    {
        $this->genders = Gender::values();
        $this->positions = Position::values();
        $this->departments = Department::pluck('name', 'id')->toArray();
    }

    public function render()
    {
        return view('livewire.personnel.create');
    }
}
