<?php

namespace App\Livewire\Others;

use App\Models\AccountingOfficer as ModelsAccountingOfficer;
use Livewire\Component;

class AccountingOfficer extends Component
{
    public $officers;

    public function mount()
    {
        $this->officers = ModelsAccountingOfficer::take(5)->get();
    }
    public function render()
    {
        return view('livewire.others.accounting-officer');
    }
}
