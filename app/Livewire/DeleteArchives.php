<?php

namespace App\Livewire;

use App\Models\Equipment;
use App\Models\Personnel;
use App\Models\Supply;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use ReflectionClass;

class DeleteArchives extends Component
{
    public $deleteHistory;
    public $modelClasses;

    public function mount()
    {
        $this->modelClasses = [
            'equipments' => Equipment::class,
            'supplies' => Supply::class,
            'personnels' => Personnel::class
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
        Gate::authorize('can-handle-delete-archives');

        $modelClass = $this->modelClasses[$type];
        $modelClass::withTrashed()->findOrFail($id)->forceDelete();

        Toaster::success('Deleted Successfully');
    }

    public function restore($id, $type)
    {
        Gate::authorize('can-handle-delete-archives');

        $modelClass = $this->modelClasses[$type];
        $modelClass::withTrashed()->findOrFail($id)->restore();

        Toaster::success('Restored Successfully');
    }
}
