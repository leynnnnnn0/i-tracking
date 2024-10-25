<?php

namespace App\Livewire\OrganizationUnit;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\OrganizationUnitForm;
use App\Models\OrganizationUnit;
use App\Traits\Updatable;
use Livewire\Component;

class Edit extends Component
{
    use Updatable;
    public $organizationUnit;
    public OrganizationUnitForm $form;
    public ActivityLogForm $activityLogForm;

    protected function getEloquentModel()
    {
        return $this->organizationUnit;
    }

    protected function getRedirectRoute(): string
    {
        return 'organization-units';
    }

    public function mount($id)
    {
        $this->organizationUnit = OrganizationUnit::findOrFail($id);
        $this->form->setOrganizationUnitForm($this->organizationUnit);
    }

    public function render()
    {
        return view('livewire.organization-unit.edit');
    }
}
