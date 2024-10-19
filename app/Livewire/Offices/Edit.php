<?php

namespace App\Livewire\Offices;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\OfficeForm;
use App\Models\Office;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    public $office;
    public OfficeForm $form;
    public ActivityLogForm $activityLogForm;

    public function mount($id)
    {
        $this->office = Office::findOrFail($id);
        $this->form->setOfficeForm($this->office);
    }
    public function render()
    {
        return view('livewire.offices.edit');
    }

    public function update()
    {
        $this->dispatch('Confirm Update');
        try {
            DB::transaction(function () {
                $office = $this->form->update($this->office);
                $this->activityLogForm->setActivityLog($this->office, $office, 'Updated Office', 'Update');
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
