<?php

namespace App\Livewire\ActivityLog;

use App\Models\ActivityLog;
use Livewire\Component;
use OwenIt\Auditing\Models\Audit;

class View extends Component
{
    public $audit;
    public function mount($id)
    {
        $this->audit = Audit::with('user')->findOrFail($id);
    }
    public function render()
    {
        return view('livewire.activity-log.view');
    }
}
