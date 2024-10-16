<?php

namespace App\Livewire;

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


    public function render()
    {
        return view('livewire.borrowed-log', [
            'logs' => BorrowedEquipment::with('equipment')->latest()->paginate(10)
        ]);
    }

    public function delete($id): void
    {
        BorrowedEquipment::findOrFail($id)->delete();
        Toaster::success('Successfully Deleted!');
        $this->dispatch('Data Deleted');
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
                $log->update([
                    'returned_date' => Carbon::today()->format('Y-m-d')
                ]);
                $log->equipment->update([
                    'status' => 'Active'
                ]);
            });
            $this->dispatch('Mark As Returned');
            Toaster::success('Mark as Returned Successfully');
        } catch (Exception $e) {
            Toaster::success($e->getMessage());
        }
    }
}
