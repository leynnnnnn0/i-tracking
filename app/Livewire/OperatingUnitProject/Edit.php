<?php

namespace App\Livewire\OperatingUnitProject;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\OperatingUnitProjectForm;
use App\Models\OperatingUnitProject;
use App\Traits\Updatable;
use Livewire\Component;

class Edit extends Component
{
    use Updatable;
    public $operatingUnit;
    public OperatingUnitProjectForm $form;
    public ActivityLogForm $activityLogForm;

    protected function getModelName(): string
    {
        return 'Operating Unit';
    }

    protected function performStoreAction()
    {
        return $this->form->update($this->operatingUnit);
    }

    protected function getRedirectRoute(): string
    {
        return route('operating-units.index');
    }

    public function mount($id)
    {
        $this->operatingUnit = OperatingUnitProject::findOrFail($id);
        $this->form->setOperatingUnitProjectForm($this->operatingUnit);
    }
    public function render()
    {
        return view('livewire.operating-unit-project.edit');
    }
}
