<?php

namespace App\Livewire\MissingEquipment;

use App\Enum\MissingStatus;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\MissingEquipmentForm;
use App\Models\Equipment;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public ActivityLogForm $activityLogForm;
    public MissingEquipmentForm $form;
    public $statuses;
    public $equipments;

    public function mount()
    {
        $this->form->reported_date = Carbon::today()->format('Y-m-d');
        $this->equipments = Equipment::pluck('name', 'id');
        $this->statuses = MissingStatus::values();
    }
    public function render()
    {
        return view('livewire.missing-equipment.create');
    }

    public function submit()
    {
        try {
            DB::transaction(function () {
                $data = $this->form->store();
                $this->activityLogForm->setActivityLog(null, $data, 'Created Missing Equipment Report', 'Create');
                $this->activityLogForm->store();
            });
            Toaster::success('Report Created.');
            return $this->redirect('/missing-equipments');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
