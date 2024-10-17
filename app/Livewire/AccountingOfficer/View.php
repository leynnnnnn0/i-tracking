<?php

namespace App\Livewire\AccountingOfficer;

use App\Models\AccountingOfficer;
use Livewire\Component;

class View extends Component
{
    public $officer;

    public function mount($id)
    {
        $this->officer = AccountingOfficer::with('office')->findOrFail($id);
        
    }
    public function render()
    {
        return view('livewire.accounting-officer.view');
    }
}
