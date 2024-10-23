<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\DepartmentForm;
use App\Traits\Submittable;
use Livewire\Component;

class Create extends Component
{
    use Submittable;
    public DepartmentForm $form;
    public ActivityLogForm $activityLogForm;
    protected function performStoreOperation()
    {
        return $this->form->store();
    }

    protected function getModelName(): string
    {
        return 'department';
    }
    public function render()
    {
        return view('livewire.department.create');
    }
}
