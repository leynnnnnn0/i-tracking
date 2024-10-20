<?php

namespace App\Livewire\Offices;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\OfficeForm;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public OfficeForm $form;
    public ActivityLogForm $activityLogForm;
    public function render()
    {
        return view('livewire.offices.create');
    }

    public function submit()
    {
        try {
            DB::transaction(function () {
                $office = $this->form->store();
                $this->activityLogForm->setActivityLog(null, $office, 'Created Office', 'Create');
                $this->activityLogForm->store();
            });
            Toaster::success('Updated Successfully');
            return $this->redirect('/offices');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
            throw $e;
        }
    }
}
