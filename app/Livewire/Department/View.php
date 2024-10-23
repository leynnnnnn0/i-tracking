<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Livewire\Component;

class View extends Component
{
    public $department;

    public function mount($id)
    {
        $this->department = Department::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.department.view');
    }
}
