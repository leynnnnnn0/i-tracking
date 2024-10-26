<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\BorrowEquipmentForm;
use App\Models\BorrowedEquipment;
use App\Traits\Deletable;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class BorrowedLog extends Component
{
    use WithPagination, Deletable;
    public BorrowEquipmentForm $borrowEquipmentForm;
    public $keyword;
    public $query = 'All';

    protected function getModel(): string
    {
        return BorrowedEquipment::class;
    }

    public function updatedKeyword()
    {
        $this->resetPage();
    }

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
        $this->resetPage();
        $this->keyword = null;
        $this->query = 'All';
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
                $borrowedEquipment = BorrowedEquipment::findOrFail($id);
                $this->borrowEquipmentForm->setBorrowEquipment($borrowedEquipment);
                $this->borrowEquipmentForm->is_returned = true;
                $this->borrowEquipmentForm->returned_date = Carbon::today()->format('Y-m-d');
                $this->borrowEquipmentForm->update($borrowedEquipment);
            });
            $this->dispatch('Mark As Returned');
            Toaster::success('Mark as Returned Successfully');
        } catch (Exception $e) {
            Toaster::success($e->getMessage());
        }
    }
}
