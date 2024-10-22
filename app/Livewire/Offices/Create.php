<?php

namespace App\Livewire\Offices;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\OfficeForm;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public OfficeForm $form;
    public ActivityLogForm $activityLogForm;
    protected function performStoreOperation()
    {
        return $this->form->store();
    }

    protected function getModelName(): string
    {
        return 'office';
    }
    public function render()
    {
        return view('livewire.offices.create');
    }

}
