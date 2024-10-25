<?php

namespace App\Livewire\Fund;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\FundForm;
use App\Traits\Submittable;
use Livewire\Component;

class Create extends Component
{
    use Submittable;
    public FundForm $form;
    public ActivityLogForm $activityLogForm;
    protected function performStoreOperation()
    {
        return $this->form->store();
    }

    protected function getModelName(): string
    {
        return 'fund';
    }
    public function render()
    {
        return view('livewire.fund.create');
    }
}
