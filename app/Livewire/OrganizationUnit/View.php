<?php

namespace App\Livewire\OrganizationUnit;

use App\Models\OrganizationUnit;
use Livewire\Component;

class View extends Component
{
    public $organizationUnit;

    public function mount($id)
    {
        $this->organizationUnit = OrganizationUnit::findOrFail($id);
    }
    
    public function render()
    {
        return view('livewire.organization-unit.view');
    }
}
