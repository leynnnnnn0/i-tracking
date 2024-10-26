<?php

namespace App\Livewire;

use App\Models\ActivityLog as ModelsActivityLog;
use Livewire\Component;
use Livewire\WithPagination;
use OwenIt\Auditing\Models\Audit;

class ActivityLog extends Component
{
    use WithPagination;
    public function render()
    {
        $audits = Audit::with('user')->latest()->paginate(10);
        return view('livewire.activity-log', [
            'logs' => ModelsActivityLog::with('user')->latest()->paginate(10),
            'audits' => $audits
        ]);
    }
}
