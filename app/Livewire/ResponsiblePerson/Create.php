<?php

namespace App\Livewire\ResponsiblePerson;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\ResponsiblePersonForm;
use App\Models\AccountingOfficer;
use App\Traits\Submittable;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    use Submittable;
    public ResponsiblePersonForm $form;
    public ActivityLogForm $activityLogForm;
    public $officers;

    protected function performStoreOperation()
    {
        return $this->form->store();
    }

    protected function getModelName(): string
    {
        return 'reponsible person';
    }

    public function mount()
    {
        $this->officers = AccountingOfficer::all()->pluck('full_name', 'id')->toArray();
    }
    public function render()
    {
        return view('livewire.responsible-person.create');
    }
}
