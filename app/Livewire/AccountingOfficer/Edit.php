<?php

namespace App\Livewire\AccountingOfficer;

use App\Livewire\Forms\AccountingOfficerForm;
use App\Models\AccountingOfficer;
use App\Models\Office;
use App\Traits\Updatable;
use Livewire\Component;


class Edit extends Component
{
    use Updatable;
    public $officer;
    public AccountingOfficerForm $form;
    public $offices;

    protected function getEloquentModel()
    {
        return $this->officer;
    }

    protected function getRedirectRoute(): string
    {
        return 'accounting-officers';
    }

    public function mount($id)
    {
        $this->offices = Office::toSelectOptions();
        $this->officer = AccountingOfficer::findOrFail($id);
        $this->form->setForm($this->officer);
    }
    public function render()
    {
        return view('livewire.accounting-officer.edit');
    }
}
