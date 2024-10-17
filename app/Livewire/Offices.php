<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Models\Office;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class Offices extends Component
{
    use WithPagination;

    public ActivityLogForm $activityLogForm;
    public function render()
    {
        return view('livewire.offices', [
            'offices' => Office::latest()->paginate(10)
        ]);
    }

    public function downloadPdf()
    {
        return redirect()->route('offices-pdf');
    }

    public function delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $office = Office::findOrFail($id);
                $office->delete();
                $this->activityLogForm->setActivityLog($office, null, 'Deleted Office', 'Delete');
                $this->activityLogForm->store();
            });
            Toaster::success('Deleted Successfully');
            $this->dispatch('Data Deleted');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
