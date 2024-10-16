<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\BorrowEquipmentForm;
use App\Models\BorrowedEquipment;
use App\Models\Equipment;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class BorrowedLog extends Component
{
    use WithPagination;
    public ActivityLogForm $activityLogForm;

    public function render()
    {
        return view('livewire.borrowed-log', [
            'logs' => BorrowedEquipment::with('equipment')->latest()->paginate(10)
        ]);
    }

    public function delete($id): void
    {
        try {
            DB::transaction(function () use ($id) {
                $equipment = BorrowedEquipment::findOrFail($id);
                $equipment->delete();
                $this->activityLogForm->setActivityLog(
                    $equipment,
                    null,
                    'Delete Borrow Log',
                    'Delete'
                );
                $this->activityLogForm->store();
            });
            Toaster::success('Successfully Deleted!');
            $this->dispatch('Data Deleted');
        } catch (Exception $e) {
            dd($e);
            Toaster::error($e->getMessage());
        }
    }

    public function downloadPdf()
    {
        return redirect()->route('borrowed-equipments');
    }

    public function returned($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $log = BorrowedEquipment::orderBy('created_at', 'desc')->findOrFail($id);
                $before = $log;
                $log->update([
                    'returned_date' => Carbon::today()->format('Y-m-d')
                ]);
                $log->equipment->update([
                    'status' => 'Active'
                ]);
                $this->activityLogForm->setActivityLog($before, $log->fresh(), 'Mark Borrowed Item as Returned', 'Update');
                $this->activityLogForm->store();
            });
            $this->dispatch('Mark As Returned');
            Toaster::success('Mark as Returned Successfully');
        } catch (Exception $e) {
            Toaster::success($e->getMessage());
        }
    }
}
