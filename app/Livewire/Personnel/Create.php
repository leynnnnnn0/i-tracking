<?php

namespace App\Livewire\Personnel;

use App\Enum\Gender;
use App\Enum\Position;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\PersonnelForm;
use App\Models\Department;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public PersonnelForm $form;
    public ActivityLogForm $activityLogForm;
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
        try {
            DB::transaction(function () {
                $personnel = $this->form->store();
                $this->activityLogForm->setActivityLog(null, $personnel, 'Create Personnel', 'Create');
                $this->activityLogForm->store();
            });
            Toaster::success('New Personnel Created!');
            return $this->redirect('/personnels');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.personnel.create');
    }
}
