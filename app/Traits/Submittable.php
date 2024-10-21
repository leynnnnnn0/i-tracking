<?php

namespace App\Traits;

use App\Livewire\Forms\ActivityLogForm;
use Exception;
use Illuminate\Support\Facades\DB;
use Masmerise\Toaster\Toaster;

trait Submittable
{
    abstract protected function performStoreOperation(): Object;
    abstract protected function getModelName(): string;

    public function submit()
    {
        dd(class_basename($this));
        $this->form->validate();
        try {
            DB::transaction(function () {
                $model = $this->performStoreOperation();
                $this->activityLogForm->setActivityLog(null, $model, $this->getActivityLogMessage(), 'Create');
                $this->activityLogForm->store();
            });
            Toaster::success($this->getSuccessMessage());
            return $this->redirect(route($this->getRedirectRoute()), true);
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }

    protected function getRedirectRoute(): string
    {
        return 'index.' . strtolower($this->getModelName());
    }

    protected function getActivityLogMessage(): string
    {
        return 'Create ' . ucfirst($this->getModelName());
    }

    protected function getSuccessMessage(): string
    {
        return 'New ' . ucfirst($this->getModelName()) . ' Created!';
    }
}
