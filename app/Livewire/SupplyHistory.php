<?php

namespace App\Livewire;

use App\Models\SupplyHistory as ModelsSupplyHistory;
use Livewire\Component;

class SupplyHistory extends Component
{
    public function render()
    {
        return view('livewire.supply-history', [
            'history' => ModelsSupplyHistory::with('supply')->latest()->paginate(10)
        ]);
    }
}
