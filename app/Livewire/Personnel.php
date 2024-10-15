<?php

namespace App\Livewire;

use App\Enum\OperatingUnitAndProject;
use App\Enum\OrganizationUnit;
use App\Livewire\Forms\ActivityLogForm;
use App\Models\Department;
use App\Models\Personnel as ModelsPersonnel;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Personnel extends Component
{
    public ActivityLogForm $activityLogForm;

    public $keyword;
    public $departments;

    public $departmentId;

    public function mount()
    {
        $this->departments = Department::pluck('name', 'id')->toArray();
    }


    public function render()
    {
        $query = ModelsPersonnel::query();
        if ($this->keyword) {
            $query->where(function ($q) {
                $q->orwhere('first_name', 'like', '%' . $this->keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $this->keyword . '%')
                    ->orWhere('middle_name', 'like', '%' . $this->keyword . '%');
            });
        }
        if ($this->departmentId) {
            $query->where('department_id', $this->departmentId);
        }

        $supplies = $query->latest()->paginate(10);

        return view('livewire.personnel', [
            'data' => $supplies
        ]);
    }

    public function resetFilter()
    {
        $this->keyword = "";
        $this->departmentId = null;
    }


    public function delete($id): void
    {
        try {
            $personnel = ModelsPersonnel::findOrFail($id);
            $personnel->delete();
            $this->activityLogForm->setActivityLog($personnel, null, 'Delete Personnel', 'Delete');
            $this->activityLogForm->store();
            Toaster::success('Successfully Deleted!');
            $this->dispatch('Data Deleted');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
