<?php

namespace App\Livewire\Equipments;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\EquipmentForm;
use App\Models\ResponsiblePerson;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public ActivityLogForm $activityLogForm;
    public EquipmentForm $form;
    public $persons;

    public function mount()
    {
        $this->persons = ResponsiblePerson::select('id', 'first_name', 'last_name')
            ->get()
            ->pluck('full_name', 'id');
    }

    public function submit()
    {
        try {
            DB::transaction(function () {
                $equipment = $this->form->store();
                $this->activityLogForm->setActivityLog(null, $equipment, 'Create Equipment', 'Create');
                $this->activityLogForm->store();
            });
            Toaster::success('New Equipment Created!');
            return $this->redirect('/equipments');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.equipments.create');
    }
}
