<?php

namespace App\Livewire\Position;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\PositionForm;
use App\Traits\Submittable;
use Livewire\Component;

class Create extends Component
{
    use Submittable;
    public PositionForm $form;
    public ActivityLogForm $activityLogForm;
    protected function performStoreOperation()
    {
        return $this->form->store();
    }

    protected function getModelName(): string
    {
        return 'position';
    }
    public function render()
    {
        return view('livewire.position.create');
    }
}
