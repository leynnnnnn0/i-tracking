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
    public function render()
    {
        $modelClasses = [
            'equipments' => Equipment::class,
            'supplies' => Supply::class,
            'personnels' => Personnel::class
        ];

        $deletedItems = collect($modelClasses)->flatMap(function ($modelClass, $type) {
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
        $modelClasses = [
            'equipments' => Equipment::class,
            'supplies' => Supply::class,
            'personnels' => Personnel::class
        ];
        $modelClass = $modelClasses[$type];
        $modelClass::withTrashed()->findOrFail($id)->forceDelete();

        Toaster::success('Deleted Successfully');
    }

    public function restore($id)
    {
        Toaster::success('Restored Successfully');
    }
}
