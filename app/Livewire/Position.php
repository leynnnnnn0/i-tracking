<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Models\Position as ModelsPosition;
use App\Traits\Deletable;
use Livewire\Component;
use Livewire\WithPagination;

class Position extends Component
{
    use WithPagination, Deletable;
    public ActivityLogForm $activityLogForm;
    protected function getModel(): string
    {
        return ModelsPosition::class;
    }
    public function render()
    {
        return view('livewire.position', [
            'positions' => ModelsPosition::latest()->paginate(10)
        ]);
    }
}
