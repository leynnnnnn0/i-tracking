<?php

namespace App\Livewire\Supply;

use App\Enum\Unit;
use App\Livewire\Forms\SupplyForm;
use App\Models\Category;
use Database\Seeders\CategorySeeder;
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
    }

    public function save()
    {
        $this->form->store();
        Toaster::success('Supply Created!');
        return $this->redirect('/supplies');
    }

    public function render()
    {
        return view('livewire.supply.create');
    }
}
