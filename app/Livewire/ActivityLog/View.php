<?php

namespace App\Livewire\ActivityLog;

use App\Models\ActivityLog;
use Livewire\Component;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Support\Str;

class View extends Component
{
    public $audit;

    public function mount($id)
    {
        $this->audit = Audit::with('user')->findOrFail($id);
    }

    public function getModified()
    {
        $modified = $this->audit->getModified();

        foreach ($modified as $key => $values) {
            if (isset($values['new']) && is_object($values['new']) && enum_exists(get_class($values['new']))) {
                $modified[$key]['new'] = Str::headline($values['new']->value);
            }
            if (isset($values['old']) && is_object($values['old']) && enum_exists(get_class($values['old']))) {
                $modified[$key]['old'] = Str::headline($values['old']->value);
            }
        }

        return $modified;
    }

    public function render()
    {
        return view('livewire.activity-log.view');
    }
}
