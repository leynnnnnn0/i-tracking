<?php

namespace App\Livewire\Position;

use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\PositionForm;
use App\Models\Position;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Edit extends Component
{
    public $position;
    public PositionForm $form;
    public ActivityLogForm $activityLogForm;
    public function mount($id)
    {
        $this->position = Position::findOrFail($id);
        $this->form->setOfficeForm($this->position);
    }
    public function update()
    {
        $this->dispatch('Confirm Update');
        $this->form->validate();
        try {
            DB::transaction(function () {
                $position = $this->form->update($this->position);
                $this->activityLogForm->setActivityLog($this->position, $position, 'Updated Position', 'Update');
                $this->activityLogForm->store();
            });
            Toaster::success('Updated Successfully');
            return $this->redirect('/positions', true);
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.position.edit');
    }
}
