<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\DB;
use Masmerise\Toaster\Toaster;

trait Updatable
{
    abstract protected function getRedirectRoute(): string;
    abstract protected function performStoreAction();

    public function update()
    {
        $this->dispatch('Confirm Update');
        $this->form->validate();
        try {
            $this->performStoreAction();
            Toaster::success('Updated Successfully');
            return $this->redirect(route($this->getRedirectRoute() . '.index'), true);
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
