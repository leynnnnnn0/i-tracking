<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\DepartmentForm;
use App\Models\Department;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    public $department;
    public DepartmentForm $form;
    public ActivityLogForm $activityLogForm;
    public function mount($id)
    {
        $this->department = Department::findOrFail($id);
        $this->form->setOfficeForm($this->department);
    }
    public function update()
    {
        $this->dispatch('Confirm Update');
        $this->form->validate();
        try {
            DB::transaction(function () {
                $department = $this->form->update($this->department);
                $this->activityLogForm->setActivityLog($this->department, $department, 'Updated Department', 'Update');
                $this->activityLogForm->store();
            });
            Toaster::success('Updated Successfully');
            return $this->redirect('/departments', true);
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.department.edit');
    }
}
