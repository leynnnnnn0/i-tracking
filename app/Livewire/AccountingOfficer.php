<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Models\AccountingOfficer as ModelsAccountingOfficer;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class AccountingOfficer extends Component
{
    public ActivityLogForm $activityLogForm;
    use WithPagination;
    public function render()
    {
        return view('livewire.accounting-officer', [
            'officers' => ModelsAccountingOfficer::with('office')->paginate(10)
        ]);
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
