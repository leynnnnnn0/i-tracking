<?php

namespace App\Livewire;

use App\Models\AccountingOfficer;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\Office;
use App\Models\Personnel;
use App\Models\ResponsiblePerson;
use App\Models\Supply;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;
use ReflectionClass;

class DeleteArchives extends Component
{
    use WithPagination;
    public $deleteHistory;
    public $modelClasses;

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
            'responsible-person' => ResponsiblePerson::class
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
        Gate::authorize('admin-access');

        $modelClass = $this->modelClasses[$type];
        $modelClass::withTrashed()->findOrFail($id)->forceDelete();


        Toaster::success('Deleted Successfully');
        $this->dispatch('Data Deleted');
    }

    public function restore($id, $type)
    {
        Gate::authorize('admin-access');

        $modelClass = $this->modelClasses[$type];
        $modelClass::withTrashed()->findOrFail($id)->restore();

        Toaster::success('Restored Successfully');
        $this->dispatch('Data Restored');
    }
}
