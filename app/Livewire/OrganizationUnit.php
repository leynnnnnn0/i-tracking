<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Models\OrganizationUnit as ModelsOrganizationUnit;
use App\Traits\Deletable;
use Livewire\Component;
use Livewire\WithPagination;

class OrganizationUnit extends Component
{
    use WithPagination, Deletable;

    public ActivityLogForm $activityLogForm;
    protected function getModel(): string
    {
        return ModelsOrganizationUnit::class;
    }
    public function render()
    {
        return view('livewire.organization-unit', [
            'organizations' => ModelsOrganizationUnit::latest()->paginate(10)
        ]);
    }
}
