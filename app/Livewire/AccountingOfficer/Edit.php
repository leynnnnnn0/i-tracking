<?php

namespace App\Livewire\AccountingOfficer;

use App\Livewire\Forms\AccountingOfficerForm;
use App\Livewire\Forms\ActivityLogForm;
use App\Models\AccountingOfficer;
use App\Models\Office;
use App\Traits\Updatable;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

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
        $this->offices = Office::select('id', 'name')
            ->get()
            ->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => $item->name
                ];
            })->toArray();
        $this->officer = AccountingOfficer::findOrFail($id);
        $this->form->setForm($this->officer);
    }
    public function render()
    {
        return view('livewire.accounting-officer.edit');
    }
}
