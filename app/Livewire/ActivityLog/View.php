<?php

namespace App\Livewire\ActivityLog;

use App\Models\ActivityLog;
use Livewire\Component;

class View extends Component
{
    public $log;
    public function mount($id)
    {
        $this->log = ActivityLog::with('user')->findOrFail($id);
    }
    public function render()
    {
        return view('livewire.activity-log.view');
    }
}
