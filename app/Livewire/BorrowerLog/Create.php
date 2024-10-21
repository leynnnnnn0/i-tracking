<?php

namespace App\Livewire\BorrowerLog;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\BorrowEquipmentForm;
use App\Models\Equipment;
use App\Traits\Submittable;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    use Submittable;
    public BorrowEquipmentForm $form;
    public ActivityLogForm $activityLogForm;
    public $equipments;
    public $quantityHint = "";

    protected function getModelName(): string
    {
        return 'borrowed log';
    }

    protected function performStoreOperation()
    {
        return $this->form->store();
    }

    public function mount()
    {
        $this->form->start_date = Carbon::today()->format('Y-m-d');
        $this->equipments = Equipment::where('status', 'Active')
            ->where('quantity', '>', 0)
            ->select('id', 'name', 'property_number')
            ->get()
            ->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => "{$item->name} (PN: {$item->property_number})"
                ];
            })
            ->toArray();
    }
    public function render()
    {
        if ($this->form->equipment_id) {
            $equipment = Equipment::with(['borrowed_log' => function ($query) {
                $query->whereNull('returned_date');
            }])->find($this->form->equipment_id);

            $borrowed = $equipment->borrowed_log->sum('quantity');
            $available = $equipment->quantity - $borrowed;
            $this->quantityHint = "Available: " . $available;
        }

        return view('livewire.borrower-log.create');
    }
}
