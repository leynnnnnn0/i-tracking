<?php

namespace App\Livewire\Offices;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\OfficeForm;
use App\Traits\Submittable;
use Livewire\Component;


class Create extends Component
{
    use Submittable;
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
