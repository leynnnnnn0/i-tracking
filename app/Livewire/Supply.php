<?php

namespace App\Livewire;

use App\Helper\ColorStatus;
use App\Models\Supply as ModelsSupply;
use Livewire\Component;
use Livewire\WithPagination;

class Supply extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.supply', [
            'data' => ModelsSupply::latest()->paginate(10)
        ]);
    }

    public function getColor($total)
    {
        return ColorStatus::getTotalColor($total);
    }

    public function delete($id)
    {
        $supply = ModelsSupply::find($id);
        if ($supply) {
            $supply->delete();
        }
    }
}
