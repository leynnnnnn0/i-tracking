<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Models\Department as ModelsDepartment;
use App\Traits\Deletable;
use Livewire\Component;
use Livewire\WithPagination;

class Department extends Component
{
    use WithPagination, Deletable;

    public ActivityLogForm $activityLogForm;

    protected function getModel(): string
    {
        return ModelsDepartment::class;
    }
    public function downloadPdf()
    {
        return redirect()->route('departments-pdf');
    }
    public function render()
    {
        return view('livewire.department', [
            'departments' => ModelsDepartment::paginate(10)
        ]);
    }
}
