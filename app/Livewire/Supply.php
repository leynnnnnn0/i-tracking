<?php

namespace App\Livewire;

use App\Helper\ColorStatus;
use App\Livewire\Forms\SupplyForm;
use App\Models\Supply as ModelsSupply;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class Supply extends Component
{
    use WithPagination;
    public SupplyForm $form;

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

    public function add($id)
    {
        $supply = ModelsSupply::findOrFail($id);

        $this->form->updateUsedValue($supply);
        Toaster::success('Updated Successfully');
        $this->dispatch('usedValueUpdated');
    }

    public function addQuantity($id)
    {
        $supply = ModelsSupply::findOrFail($id);
        $this->form->updateQuantity($supply);
        Toaster::success('Quantity Updated');
        $this->dispatch('quantityValueUpdated');
    }
}
