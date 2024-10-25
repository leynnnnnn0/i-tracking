<?php

namespace App\Livewire\OrganizationUnit;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\OrganizationUnitForm;
use App\Traits\Submittable;
use Livewire\Component;

class Create extends Component
{
    use Submittable;
    public OrganizationUnitForm $form;
    public ActivityLogForm $activityLogForm;
    protected function performStoreOperation()
    {
        return $this->form->store();
    }

    protected function getModelName(): string
    {
        return 'organization unit';
    }
    public function render()
    {
        return view('livewire.organization-unit.create');
    }
}
