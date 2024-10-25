<?php

namespace App\Livewire\Offices;

use App\Livewire\Forms\OfficeForm;
use App\Models\Office;
use App\Traits\Updatable;
use Livewire\Component;


class Edit extends Component
{
    use Updatable;
    public $office;
    public OfficeForm $form;

    protected function getRedirectRoute(): string
    {
        return 'offices';
    }

    protected function getEloquentModel()
    {
        return $this->form->update($this->office);
    }

    public function mount($id)
    {
        $this->office = Office::findOrFail($id);
        $this->form->setOfficeForm($this->office);
    }

    public function render()
    {
        return view('livewire.offices.edit');
    }
}
