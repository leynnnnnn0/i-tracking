<?php

namespace App\Livewire;

use App\Models\Equipment;
use App\Models\Personnel;
use App\Models\Supply;
use Livewire\Component;

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
}
