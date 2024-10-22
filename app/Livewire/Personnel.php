<?php

namespace App\Livewire;

use App\Enum\Position;
use App\Livewire\Forms\ActivityLogForm;
use App\Models\Department;
use App\Models\Personnel as ModelsPersonnel;
use App\Traits\Deletable;
use Livewire\Component;
use Livewire\WithPagination;

class Personnel extends Component
{
    use WithPagination, Deletable;
    public ActivityLogForm $activityLogForm;
    public $keyword;
    public $departments;
    public $positions;

    public $departmentId;
    public $position;

    protected function getModel(): string
    {
        return ModelsPersonnel::class;
    }

    public function mount()
    {
        $this->departments = Department::pluck('name', 'id')->toArray();
        $this->positions = Position::values();
    }

    public function downloadPdf()
    {

        $params = [
            'keyword' => $this->keyword ?? "",
            'departmentId' => $this->departmentId ?? "",
            'position' => $this->position ?? "",
        ];

        $params = array_filter($params, function ($value) {
            return $value !== null && $value !== '';
        });


        return redirect()->route('personnels-pdf', $params);
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

        if ($this->position) {
            $query->where('position', $this->position);
        }

        $personnels = $query->latest()->paginate(10);

        return view('livewire.personnel', [
            'data' => $personnels
        ]);
    }

    public function resetFilter()
    {
        $this->keyword = "";
        $this->departmentId = null;
        $this->position = null;
    }
}
