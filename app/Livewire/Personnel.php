<?php

namespace App\Livewire;


use App\Livewire\Forms\ActivityLogForm;
use App\Models\Department;
use App\Models\Office;
use App\Models\Personnel as ModelsPersonnel;
use App\Models\Position;
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
    public $offices;
    public $departmentId;
    public $positionId;
    public $officeId;

    public function updatedKeyword()
    {
        $this->resetPage();
    }

    public function updatedPositionId()
    {
        $this->resetPage();
    }

    public function updatedOfficeId()
    {
        $this->resetPage();
    }

    public function updatedDepartmentId()
    {
        $this->resetPage();
    }

    protected function getModel(): string
    {
        return ModelsPersonnel::class;
    }

    public function mount()
    {
        $this->departments = Department::select('name', 'id')
            ->get()
            ->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => $item->name,
                ];
            });;
        $this->positions = Position::select('name', 'id')
            ->get()
            ->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => $item->name,
                ];
            });;
        $this->offices = Office::select('name', 'id')
            ->get()
            ->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => $item->name,
                ];
            });;
    }

    public function downloadPdf()
    {

        $params = [
            'keyword' => $this->keyword,
            'departmentId' => $this->departmentId,
            'positionId' => $this->positionId,
            'officeId' => $this->officeId
        ];

        $params = array_filter($params, function ($value) {
            return $value !== null;
        });


        return redirect()->route('personnels-pdf', $params);
    }



    public function render()
    {
        $query = ModelsPersonnel::query()
            ->with('office', 'department', 'position');

        if ($this->keyword) {
            $query->whereAny(['first_name', 'middle_name', 'last_name'], 'like', '%' . $this->keyword . '%');
        }

        if ($this->departmentId) {
            $query->where('department_id', $this->departmentId);
        }

        if ($this->positionId) {
            $query->where('position_id', $this->positionId);
        }

        if ($this->officeId) {
            $query->where('office_id', $this->officeId);
        }

        $personnels = $query->latest()->paginate(10);

        return view('livewire.personnel', [
            'data' => $personnels
        ]);
    }

    public function resetFilter()
    {
        $this->resetPage();
        $this->keyword = null;
        $this->departmentId = null;
        $this->positionId = null;
        $this->officeId = null;
    }
}
