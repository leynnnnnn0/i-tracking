<?php

namespace App\Livewire\ResponsiblePerson;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\ResponsiblePersonForm;
use App\Models\AccountingOfficer;
use App\Models\ResponsiblePerson;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    public $person;
    public ResponsiblePersonForm $form;
    public ActivityLogForm $activityLogForm;
    public $officers;

    public function mount($id)
    {
        $this->officers = AccountingOfficer::select('id', 'first_name', 'last_name')->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'label' => $item->full_name
            ];
        })->toArray();
        $this->person = ResponsiblePerson::findOrFail($id);
        $this->form->setForm($this->person);
    }
    public function render()
    {
        return view('livewire.responsible-person.edit');
    }

    public function update()
    {
        $this->dispatch('Confirm Update');
        $this->form->validate();
        try {
            DB::transaction(function () {
                $person = $this->form->update($this->person);
                $this->activityLogForm->setActivityLog($this->person, $person, 'Updated Responsible Person', 'Update');
                $this->activityLogForm->store();
            });
            Toaster::success('Updated Successfully');
            return $this->redirect('/responsible-people', true);
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
