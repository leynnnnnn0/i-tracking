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
    public $keyword;
    public $query = 'All';

    public function render()
    {
        $query = BorrowedEquipment::query()->with('equipment');
        if ($this->query == 'Returned') {
            $query->whereNotNull('returned_date');
        }
        if ($this->query == 'Not Returned') {
            $query->whereNull('returned_date');
        }
        if ($this->keyword) {
            $query->whereAny(['borrower_first_name', 'borrower_last_name'], 'like', "%$this->keyword%")
                ->orWhereHas('equipment', function ($q) {
                    $q->where('name', 'like', "%$this->keyword%");
                });
        }
        $logs = $query->latest()->paginate();
        return view('livewire.borrowed-log', [
            'logs' => $logs
        ]);
    }

    public function setQuery($query)
    {
        $this->query = $query;
    }

    public function resetFilter()
    {
        $this->keyword = null;
        $this->query = 'All';
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
        $params = [
            'keyword' => $this->keyword,
            'filter' => $this->query,
        ];
        $params = array_filter($params, function ($value) {
            return $value !== null;
        });
        return redirect()->route('borrowed-equipments', $params);
    }

    public function returned($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $log = BorrowedEquipment::orderBy('created_at', 'desc')->findOrFail($id);
                $before = $log;
                $log->update([
                    'is_returned' => true,
                    'returned_date' => Carbon::today()->format('Y-m-d')
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
