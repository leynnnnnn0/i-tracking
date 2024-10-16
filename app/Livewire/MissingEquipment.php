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
    public ActivityLogForm $activityLogForm;
    public function render()
    {
        return view('livewire.missing-equipment', [
            'data' => ModelsMissingEquipment::with('equipment')->latest()->paginate(10)
        ]);
    }

    public function condemned($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $equipment = Equipment::findOrFail($id)->update([
                    'status' => EquipmentStatus::CONDEMNED->value
                ]);
                dd($equipment);
            });
            $this->dispatch('Condemned');
            Toaster::success('Updated Successfully');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
