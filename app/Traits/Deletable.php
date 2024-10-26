<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Masmerise\Toaster\Toaster;
use Illuminate\Support\Str;

trait Deletable
{
    abstract protected function getModel(): string;

    public function delete($id)
    {
        try {
            if ($this->beforeTransaction($id)) {
                return;
            }
            $model = $this->getModel()::findOrFail($id);
            $model->delete();
            Toaster::success('Successfully Deleted!');
            $this->dispatch('Data Deleted');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        } finally {
            $this->dispatch('Data Deleted');
        }
    }

    protected function beforeTransaction($id): bool
    {
        return false;
    }
}
