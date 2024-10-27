<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\DB;
use Masmerise\Toaster\Toaster;

trait Updatable
{
    abstract protected function getRedirectRoute(): string;
    abstract protected function getEloquentModel();

    public function update()
    {
        $this->dispatch('Confirm Update');
        $this->beforeTransaction();
        $this->form->validate();
        try {
            DB::transaction(function () {
                $model = $this->form->update($this->getEloquentModel());
                $this->afterTransaction($model);
            });
            Toaster::success('Updated Successfully');
            return $this->redirect(route($this->getRedirectRoute() . '.index'), true);
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }

    protected function afterTransaction($model) {}
    protected function beforeTransaction() {}
}
