<?php

namespace App\Livewire\Personnel;

use App\Enum\Gender;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\PersonnelForm;
use App\Models\Department;
use App\Models\Office;
use App\Models\Position;
use App\Traits\Submittable;
use Livewire\Component;

class Create extends Component
{
    use Submittable;
    public PersonnelForm $form;
    public ActivityLogForm $activityLogForm;
    public $genders;
    public $positions;
    public $departments;
    public $offices;

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
        $this->departments = Department::select('name', 'id')->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'label' => $item->name
            ];
        })->toArray();
        $this->positions = Position::select('name', 'id')->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'label' => $item->name
            ];
        })->toArray();
        $this->offices = Office::select('name', 'id')->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'label' => $item->name
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.personnel.create');
    }
}
