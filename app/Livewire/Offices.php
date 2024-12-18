<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Traits\Deletable;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Office as ModelsOffice;

class Offices extends Component
{
    use WithPagination, Deletable;

    public ActivityLogForm $activityLogForm;

    protected function getModel(): string
    {
        return ModelsOffice::class;
    }

    public function render()
    {
        return view('livewire.offices', [
            'offices' => ModelsOffice::latest()->paginate(10)
        ]);
    }

    public function downloadPdf()
    {
        return redirect()->route('offices-pdf');
    }

    
}
