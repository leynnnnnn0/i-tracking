<?php

namespace App\Livewire;

use App\Enum\EquipmentStatus;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\MissingEquipmentForm;
use App\Models\MissingEquipment as ModelsMissingEquipment;
use App\Models\Equipment;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class MissingEquipment extends Component
{
    public $query = 'All';
    public ActivityLogForm $activityLogForm;
    public MissingEquipmentForm $form;


    public function setQuery($query)
    {
        $this->query = $query;
    }
    public function render()
    {
        $query = ModelsMissingEquipment::query()->with('equipment');
        if ($this->query !== 'All') {
            if ($this->query === 'Condemned') {
                $query->where('is_condemned', true);
            } else {
                $query->where('status', $this->query);
            }
        }
        $data = $query->latest()->paginate(10);
        return view('livewire.missing-equipment', [
            'data' => $data
        ]);
    }

    public function downloadPdf()
    {
        return redirect()->route('missing-equipments-pdf');
    }

    public function condemned($reportId)
    {
        try {
            DB::transaction(function () use ($reportId) {
                $before = ModelsMissingEquipment::findOrFail($reportId);
                $before->update([
                    'is_condemned' => true,
                ]);
                $this->form->setMissingEquipmentForm($before);
                $this->form->condemned($before->equipment_id);

                $this->activityLogForm->setActivityLog($before, $before->fresh(), 'Tag Missing Equipment as Condemned', 'Update');
                $this->activityLogForm->store();
            });
            $this->dispatch('Condemned');
            Toaster::success('Updated Successfully');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
