<?php

namespace App\Livewire\Supply;

use App\Enum\Unit;
use App\Livewire\Forms\SupplyForm;
use App\Models\Category;
use App\Models\Supply;
use App\Traits\Updatable;
use Livewire\Component;

class Edit extends Component
{
    use Updatable;
    public SupplyForm $form;
    public $units;
    public $categories;
    public $supply;
    protected function getRedirectRoute(): string
    {
        return 'supplies';
    }

    protected function getEloquentModel()
    {
        return $this->form->update($this->supply);
    }
    public function addToCategories($id)
    {
        $categoriesArray = $this->form->category->toArray();
        if (in_array($id, $categoriesArray)) {
            $this->form->category = collect(array_diff($categoriesArray, [$id]));
            return;
        }
        $this->form->category->push((int)$id);
    }
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
