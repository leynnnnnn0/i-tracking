<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Models\PersonalProtectiveEquipment as ModelsPersonalProtectiveEquipment;
use App\Traits\Deletable;
use Livewire\Component;
use Livewire\WithPagination;

class PersonalProtectiveEquipment extends Component
{
    use WithPagination, Deletable;

    public ActivityLogForm $activityLogForm;

    protected function getModel(): string
    {
        return ModelsPersonalProtectiveEquipment::class;
    }

    public function render()
    {
        return view('livewire.personal-protective-equipment', [
            'personalProtectiveEquipment' => ModelsPersonalProtectiveEquipment::latest()->paginate(10)
        ]);
    }
}
