<?php

namespace App\Livewire\OperatingUnitProject;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\OperatingUnitProjectForm;
use App\Traits\Submittable;
use Livewire\Component;

class Create extends Component
{
    use Submittable;
    public OperatingUnitProjectForm $form;
    public ActivityLogForm $activityLogForm;
    protected function performStoreOperation()
    {
        return $this->form->store();
    }

    protected function getModelName(): string
    {
        return 'operating unit';
    }
    public function render()
    {
        return view('livewire.operating-unit-project.create');
    }
}
