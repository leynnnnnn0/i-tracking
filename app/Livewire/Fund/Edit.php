<?php

namespace App\Livewire\Fund;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\FundForm;
use App\Models\Fund;
use App\Traits\Updatable;
use Livewire\Component;

class Edit extends Component
{
    use Updatable;
    public $fund;
    public FundForm $form;
    public ActivityLogForm $activityLogForm;

    protected function getEloquentModel()
    {
        return $this->fund;
    }
    protected function getRedirectRoute(): string
    {
        return 'funds';
    }

    public function mount($id)
    {
        $this->fund = Fund::findOrFail($id);
        $this->form->setFundForm($this->fund);
    }

    public function render()
    {
        return view('livewire.fund.edit');
    }
}
