<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Form;
use Masmerise\Toaster\Toaster;

trait Updatable
{
    abstract protected function getModelName(): string;
    abstract protected function getRedirectRoute(): string;
    abstract protected function performStoreAction();

    public function update()
    {
        $this->dispatch('Confirm Update');
        $this->form->validate();
        try {
            DB::transaction(function () {
                $model = $this->performStoreAction();
                $this->activityLogForm->setActivityLog($model, $model, 'Updated' . $this->getModelName(), 'Update');
                $this->activityLogForm->store();
            });
            Toaster::success('Updated Successfully');
            return $this->redirect($this->getRedirectRoute(), true);
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
