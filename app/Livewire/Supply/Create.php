<?php

namespace App\Livewire\Supply;

use App\Enum\Unit;
use App\Livewire\Forms\SupplyForm;
use App\Models\Category;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public SupplyForm $form;
    public $units;
    public $categories;


    public function mount()
    {
        $this->units = Unit::values();
        $this->categories = Category::pluck('name', 'id')->toArray();
        $this->form->category = [];
    }

    public function save()
    {
        $this->form->store();
        Toaster::success('Supply Created!');
        return $this->redirect('/supplies');
    }

    public function addToCategories($id)
    {
        $categoriesArray = $this->form->category;
        if (in_array($id, $categoriesArray)) {
            $this->form->category = array_diff($categoriesArray, [$id]);
            return;
        }
        $this->form->category[] = (int)$id;
    }

    public function render()
    {
        return view('livewire.supply.create');
    }
}
