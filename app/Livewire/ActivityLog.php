<?php

namespace App\Livewire;

use App\Models\ActivityLog as ModelsActivityLog;
use Livewire\Component;
use Livewire\WithPagination;

class ActivityLog extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.activity-log', [
            'logs' => ModelsActivityLog::latest()->paginate(10)
        ]);
    }
}
