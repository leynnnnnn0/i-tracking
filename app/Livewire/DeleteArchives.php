<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Models\AccountingOfficer;
use App\Models\Category;
use App\Models\Department;
use App\Models\Equipment;
use App\Models\Office;
use App\Models\Personnel;
use App\Models\Position;
use App\Models\ResponsiblePerson;
use App\Models\Supply;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class DeleteArchives extends Component
{
    use WithPagination;
    public $deleteHistory;
    public $modelClasses;
    public ActivityLogForm $activityLogForm;

    public function mount()
    {
        $this->modelClasses = [
            'equipments' => Equipment::class,
            'supplies' => Supply::class,
            'personnels' => Personnel::class,
            'users' => User::class,
            'offices' => Office::class,
            'categories' => Category::class,
            'accounting-officers' => AccountingOfficer::class,
            'responsible-person' => ResponsiblePerson::class,
            'departments' => Department::class,
            'positions' => Position::class
        ];
    }
    public function render()
    {

        $deletedItems = collect($this->modelClasses)->flatMap(function ($modelClass, $type) {
            return $modelClass::onlyTrashed()->get()->map(function ($item) use ($type) {
                $item->type = $type;
                return $item;
            });
        });
        return view('livewire.delete-archives', compact('deletedItems'));
    }

    public function delete($id, $type)
    {
        try {
            DB::transaction(function () use ($id, $type) {
                $modelClass = $this->modelClasses[$type];
                $model = $modelClass::withTrashed()->findOrFail($id);
                $model->forceDelete();
                $this->activityLogForm->setActivityLog($model, null, 'Deleted Data Permanently', 'Delete');
                $this->activityLogForm->store();
            });
            Toaster::success('Deleted Successfully');
            $this->dispatch('Data Deleted');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }

    public function restore($id, $type)
    {
        try {
            DB::transaction(function () use ($id, $type) {
                $modelClass = $this->modelClasses[$type];
                $model = $modelClass::withTrashed()->findOrFail($id);
                $model->restore();
                $this->activityLogForm->setActivityLog($model, null, 'Restored Data', 'Restore');
                $this->activityLogForm->store();
            });
            Toaster::success('Restored Successfully');
            $this->dispatch('Data Restored');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
