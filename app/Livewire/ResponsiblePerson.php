<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Models\AccountingOfficer;
use App\Models\ResponsiblePerson as ModelsResponsiblePerson;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class ResponsiblePerson extends Component
{
    use WithPagination;
    public ActivityLogForm $activityLogForm;
    public $keyword;
    public $officers;
    public $officer;

    public function mount()
    {
        $this->officers = AccountingOfficer::all()->pluck('full_name', 'id');
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

    public function delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $person = ModelsResponsiblePerson::findOrFail($id);
                $person->delete();
                $this->activityLogForm->setActivityLog($person, null, 'Deleted Responsible Person', 'Delete');
                $this->activityLogForm->store();
            });
            Toaster::success('Deleted Successfully');
            $this->dispatch('Data Deleted');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
