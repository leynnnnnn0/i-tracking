<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Traits\Deletable;
use Livewire\Component;
use Livewire\WithPagination;

class OperatingUnitProject extends Component
{
    use WithPagination, Deletable;

    public ActivityLogForm $activityLogForm;
    protected function getModel(): string
    {
        return \App\Models\OperatingUnitProject::class;
    }
    public function render()
    {
        return view('livewire.operating-unit-project', [
            'operatingUnits' => \App\Models\OperatingUnitProject::latest()->paginate(10)
        ]);
    }
}
