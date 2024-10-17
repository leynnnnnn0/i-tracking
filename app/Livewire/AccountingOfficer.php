<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Models\AccountingOfficer as ModelsAccountingOfficer;
use App\Models\Office;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class AccountingOfficer extends Component
{
    use WithPagination;
    public $keyword;
    public $offices;
    public $office;
    public ActivityLogForm $activityLogForm;
    public function mount()
    {
        $this->offices = Office::pluck('name', 'id');
    }
    public function render()
    {
        $query = ModelsAccountingOfficer::query()->with('office');

        if ($this->keyword) {
            $query->whereAny(['first_name', 'last_name', 'email'], $this->keyword);
        }

        if ($this->office) {
            $query->where('office_id', $this->office);
        }

        $offices = $query->latest()->paginate(10);
        return view('livewire.accounting-officer', [
            'officers' => $offices
        ]);
    }

    public function downloadPdf()
    {
        $params = [
            'keyword' => $this->keyword,
            'office' => $this->office
        ];

        $params = array_filter($params, function ($value) {
            return $value !== null && $value !== '';
        });


        return redirect()->route('accounting-officers-pdf', $params);
    }

    public function resetFilter()
    {
        $this->keyword = null;
        $this->office = null;
    }

    public function delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $officer = ModelsAccountingOfficer::findOrFail($id);
                $officer->delete();
                $this->activityLogForm->setActivityLog($officer, null, 'Deleted Accounting Officer', 'Delete');
                $this->activityLogForm->store();
            });
            Toaster::success('Deleted Successfully');
            $this->dispatch('Data Deleted');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
