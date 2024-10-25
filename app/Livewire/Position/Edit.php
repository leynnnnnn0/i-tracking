<?php

namespace App\Livewire\Position;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\PositionForm;
use App\Models\Position;
use App\Traits\Updatable;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    use Updatable;
    public $position;
    public PositionForm $form;

    protected function getRedirectRoute(): string
    {
        return 'positions';
    }

    protected function getEloquentModel()
    {
        return $this->form->update($this->position);
    }


    public function mount($id)
    {
        $this->position = Position::findOrFail($id);
        $this->form->setOfficeForm($this->position);
    }
    public function render()
    {
        return view('livewire.position.edit');
    }
}
