<?php

namespace App\Livewire\AccountingOfficer;

use App\Livewire\Forms\AccountingOfficerForm;
use App\Livewire\Forms\ActivityLogForm;
use App\Models\AccountingOfficer;
use App\Models\Office;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    public $officer;
    public AccountingOfficerForm $form;
    public ActivityLogForm $activityLogForm;
    public $offices;

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

    public function update()
    {
        $this->dispatch('Confirm Update');
        $this->form->validate();
        try {

            DB::transaction(function () {
                $officer = $this->form->update($this->officer);
                $this->activityLogForm->setActivityLog($this->officer, $officer, 'Updated Accounting Officer', 'Update');
                $this->activityLogForm->store();
            });
            Toaster::success('Updated Successfully');
            return $this->redirect('/accounting-officers', true);
        } catch (Exception $e) {

            dd($e);
            Toaster::error($e->getMessage());
        }
    }
}
