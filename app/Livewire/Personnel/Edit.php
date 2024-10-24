<?php

namespace App\Livewire\Personnel;

use App\Enum\Gender;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\PersonnelForm;
use App\Models\Department;
use App\Models\Office;
use App\Models\Personnel;
use App\Models\Position;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    public ActivityLogForm $activityLogForm;
    public PersonnelForm $form;
    public $genders;
    public $positions;
    public $departments;
    public $personnel;
    public $offices;

    public function mount($id)
    {
        $this->genders = Gender::values();
        $this->positions = Position::select('name', 'id')->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'label' => $item->name
            ];
        })->toArray();
        $this->offices = Office::select('name', 'id')->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'label' => $item->name
            ];
        })->toArray();
        $this->departments = Department::select('name', 'id')->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'label' => $item->name
            ];
        })->toArray();
        $this->personnel = Personnel::findOrFail($id);
        $this->form->setPersonnel($this->personnel);
    }
    public function render()
    {
        return view('livewire.personnel.edit');
    }

    public function update()
    {
        $this->dispatch('Confirm Update');
        try {
            DB::transaction(function () {
                $personnel = $this->form->update($this->personnel);
                $this->activityLogForm->setActivityLog($this->personnel, $personnel, 'Update Personnel', 'Update');
                $this->activityLogForm->store();
            });
            Toaster::success('Updated Successfully!');
            return $this->redirect(route('personnel.index'), true);
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
            throw $e;
        }
    }
}
