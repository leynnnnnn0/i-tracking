<?php

namespace App\Livewire\AccountingOfficer;

use App\Livewire\Forms\AccountingOfficerForm;
use App\Livewire\Forms\ActivityLogForm;
use App\Models\Office;
use App\Traits\Submittable;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    use Submittable;
    public AccountingOfficerForm $form;
    public $offices;

    protected function performStoreOperation()
    {
        return $this->form->store();
    }

    protected function getModelName(): string
    {
        return 'accounting officer';
    }

    public function mount()
    {
        $this->offices = Office::toSelectOptions();
    }
    public function render()
    {
        return view('livewire.accounting-officer.create');
    }
}
