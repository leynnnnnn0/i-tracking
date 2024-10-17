<?php

namespace App\Livewire\ResponsiblePerson;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\ResponsiblePersonForm;
use App\Models\AccountingOfficer;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public ResponsiblePersonForm $form;
    public ActivityLogForm $activityLogForm;
    public $officers;

    public function mount()
    {
        $this->officers = AccountingOfficer::all()->pluck('full_name', 'id')->toArray();
    }
    public function render()
    {
        return view('livewire.responsible-person.create');
    }
    public function submit()
    {
        try {
            DB::transaction(function () {
                $officer = $this->form->store();
                $this->activityLogForm->setActivityLog(null, $officer, 'Created Responsible Person', 'Create');
                $this->activityLogForm->store();
            });
            Toaster::success('Created Successfully');
            return $this->redirect('/responsible-persons');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
