<?php

namespace App\Livewire;

use App\Enum\EquipmentStatus;
use App\Livewire\Forms\ActivityLogForm;
use App\Models\Equipment;
use App\Models\MissingEquipment as ModelsMissingEquipment;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class MissingEquipment extends Component
{
    public $query = 'All';
    public ActivityLogForm $activityLogForm;

    public function setQuery($query)
    {
        $this->query = $query;
    }
    public function render()
    {
        $query = ModelsMissingEquipment::query()->with('equipment');
        if ($this->query !== 'All') {
            if ($this->query === 'Condemned') {
                $query->whereHas('equipment', function ($q) {
                    $q->where('status', $this->query);
                });
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

    public function condemned($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $equipment = Equipment::findOrFail($id);
                $before = $equipment;
                $equipment->update([
                    'status' => EquipmentStatus::CONDEMNED->value
                ]);

                $this->activityLogForm->setActivityLog($before, $equipment->fresh(), 'Tag Equipment as Condmened', 'Update');
                $this->activityLogForm->store();
            });
            $this->dispatch('Condemned');
            Toaster::success('Updated Successfully');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
