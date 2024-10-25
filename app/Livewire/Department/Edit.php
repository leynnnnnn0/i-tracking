<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\DepartmentForm;
use App\Models\Department;
use App\Traits\Updatable;
use Livewire\Component;

class Edit extends Component
{
    use Updatable;
    public $department;
    public DepartmentForm $form;
    public ActivityLogForm $activityLogForm;
    protected function getRedirectRoute(): string
    {
        return 'departments';
    }

    protected function getEloquentModel()
    {
        return $this->department;
    }
    public function mount($id)
    {
        $this->department = Department::findOrFail($id);
        $this->form->setOfficeForm($this->department);
    }

    public function render()
    {
        return view('livewire.department.edit');
    }
}
