<?php

namespace App\Livewire\Others;

use App\Models\Category as ModelsCategory;
use Livewire\Component;

class Category extends Component
{
    public $categories;

    public function mount()
    {
        $this->categories = ModelsCategory::take(5)->get();
    }
    public function render()
    {
        return view('livewire.others.category');
    }
}
