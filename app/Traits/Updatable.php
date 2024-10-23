<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Form;
use Masmerise\Toaster\Toaster;

trait Updatable
{
    abstract protected function getModelName(): string;
    public function update()
    {
        $this->dispatch('Confirm Update');
        $this->form()->validate();
        try {
            DB::transaction(function () {
                $office = $this->form->update($this->office);
                $this->activityLogForm->setActivityLog($this->office, $office, 'Updated Office', 'Update');
                $this->activityLogForm->store();
            });
            Toaster::success('Updated Successfully');
            return $this->redirect('/offices', true);
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }

}
