<?php

namespace App\Livewire\ResponsiblePerson;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\ResponsiblePersonForm;
use App\Models\AccountingOfficer;
use App\Traits\Submittable;
use Livewire\Component;

class Create extends Component
{
    use Submittable;
    public ResponsiblePersonForm $form;
    public ActivityLogForm $activityLogForm;
    public $officers;

    protected function performStoreOperation()
    {
        return $this->form->store();
    }

    protected function getModelName(): string
    {
        return 'responsible person';
    }

    public function mount()
    {
        $this->officers = AccountingOfficer::all()
            ->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => $item->full_name
                ];
            })
            ->toArray();
    }
    public function render()
    {
        return view('livewire.responsible-person.create');
    }
}
