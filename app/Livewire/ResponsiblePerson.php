<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Models\AccountingOfficer;
use App\Models\ResponsiblePerson as ModelsResponsiblePerson;
use App\Traits\Deletable;
use Livewire\Component;
use Livewire\WithPagination;

class ResponsiblePerson extends Component
{
    use WithPagination, Deletable;
    public ActivityLogForm $activityLogForm;
    public $keyword;
    public $officers;
    public $officer;

    public function mount()
    {
        $this->officers = AccountingOfficer::all()->pluck('full_name', 'id');
    }

    protected function getModel(): string
    {
        return ModelsResponsiblePerson::class;
    }

    public function downloadPdf()
    {
        $params = [
            'keyword' => $this->keyword,
            'officer' => $this->officer
        ];

        $params = array_filter($params, function ($value) {
            return $value !== null && $value !== '';
        });


        return redirect()->route('responsible-persons-pdf', $params);
    }

    public function resetFilter()
    {
        $this->keyword = null;
        $this->officer = null;
    }

    public function render()
    {
        $query = ModelsResponsiblePerson::query()->with('accounting_officer');

        if ($this->keyword) {
            $query->whereAny(['first_name', 'last_name', 'email'],  'like', "%$this->keyword%");
        }

        if ($this->officer) {
            $query->where('accounting_officer_id', $this->officer);
        }

        $persons = $query->latest()->paginate(10);
        return view('livewire.responsible-person', [
            'persons' => $persons
        ]);
    }
}
