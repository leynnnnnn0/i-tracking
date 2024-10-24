<?php

namespace App\Livewire\Supply;

use App\Models\Supply;
use Livewire\Component;

class View extends Component
{
    public $supply;
    public $categories;

    public function mount($id)
    {
        $this->supply = Supply::with('categories')->findOrFail($id);
        $this->categories = implode(' / ', $this->supply->categories->map(function ($item) {
            return $item->name;
        })->toArray());
    }
    public function render()
    {
        return view('livewire.supply.view');
    }
}
