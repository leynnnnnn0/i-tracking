<?php

namespace App\Livewire\BorrowerLog;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\BorrowEquipmentForm;
use App\Models\Equipment;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public BorrowEquipmentForm $form;
    public ActivityLogForm $activityLogForm;
    public $equipments;

    public function mount()
    {
        $this->equipments = Equipment::where('status', 'Active')->get()->pluck('name', 'id');
    }
    public function render()
    {
        return view('livewire.borrower-log.create');
    }

    public function submit()
    {
        try {
            DB::transaction(function () {
                $data = $this->form->store();
                $this->activityLogForm->setActivityLog(null, $data, 'Created Borrow Log', 'Create');
                $this->activityLogForm->store();
            });
            Toaster::success('Successfully Created!');
            return $this->redirect('/borrowed-logs');
        } catch (Exception $e) {
        }
    }
}
