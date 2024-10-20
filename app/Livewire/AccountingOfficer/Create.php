<?php

namespace App\Livewire\AccountingOfficer;

use App\Livewire\Forms\AccountingOfficerForm;
use App\Livewire\Forms\ActivityLogForm;
use App\Models\Office;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public AccountingOfficerForm $form;
    public ActivityLogForm $activityLogForm;
    public $offices;

    public function mount()
    {
        $this->offices = Office::pluck('name', 'id')->toArray();
    }
    public function render()
    {
        return view('livewire.accounting-officer.create');
    }
    public function submit()
    {
        try {
            DB::transaction(function () {
                $officer = $this->form->store();
                $this->activityLogForm->setActivityLog(null, $officer, 'Created Accounting Officer', 'Create');
                $this->activityLogForm->store();
            });
            Toaster::success('Created Successfully');
            return $this->redirect('/accounting-officers');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
            throw $e;
        }
    }
}
