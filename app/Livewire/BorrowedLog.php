<?php

namespace App\Livewire;

use App\Enum\MissingStatus;
use App\Livewire\Forms\BorrowEquipmentForm;
use App\Livewire\Forms\MissingEquipmentForm;
use App\Models\BorrowedEquipment;
use App\Models\Equipment;
use App\Traits\Deletable;
use App\Traits\Submittable;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class BorrowedLog extends Component
{
    use WithPagination, Deletable, Submittable;
    public BorrowEquipmentForm $borrowEquipmentForm;
    public MissingEquipmentForm $form;
    public $keyword;
    public $query = 'All';
    public $statuses;
    public $equipmentList;

    protected function performStoreOperation()
    {
        return $this->form->store();
    }

    protected function getModelName(): string
    {
        return 'Missing Equipment Report';
    }

    #[On('set-target-log-id')]
    public function setTargetLogId($targetLogId)
    {
        $log = BorrowedEquipment::findOrFail($targetLogId);
        $this->equipmentList = Equipment::toSelectOptions();
        $this->form->equipment_id = $log->equipment_id;
        $this->form->quantity = $log->quantity;
        $this->form->borrowed_equipment_id = $targetLogId;
        $this->form->reported_date = today()->format('Y-m-d');
    }

    public function mount()
    {
        $this->statuses = MissingStatus::values();
    }

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
