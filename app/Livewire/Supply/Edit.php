<?php

namespace App\Livewire\Supply;

use App\Enum\Unit;
use App\Livewire\Forms\SupplyForm;
use App\Models\Category;
use App\Models\Supply;
use Livewire\Component;

class Edit extends Component
{
    public SupplyForm $form;
    public $units;
    public $categories;

    public $supply;
    public function mount($id)
    {
        $this->supply = Supply::with('categories')->findOrFail($id);
        $this->units = Unit::values();
        $this->categories = Category::pluck('name', 'id')->toArray();
        $this->form->setSupply($this->supply);
    }
    public function render()
    {
        return view('livewire.supply.edit');
    }
}
