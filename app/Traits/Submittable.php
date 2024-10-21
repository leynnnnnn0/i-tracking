<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\DB;
use Masmerise\Toaster\Toaster;
use Illuminate\Support\Str;


trait Submittable
{
    abstract protected function performStoreOperation();
    abstract protected function getModelName(): string;

    public function submit()
    {
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
        return Str::plural(strtolower($this->getModelName())) . '.index';
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
