<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Masmerise\Toaster\Toaster;

trait Deletable
{
    abstract protected function getModel(): string;

    public function delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $model = $this->getModel()::findOrFail($id);
                $model->delete();
                $this->activityLogForm->setActivityLog($model, null, 'Delete Equipment', 'Delete');
                $this->activityLogForm->store();
            });
            Toaster::success('Successfully Deleted!');
            $this->dispatch('Data Deleted');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
