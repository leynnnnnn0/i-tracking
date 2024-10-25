<?php

namespace App\Livewire\Fund;

use App\Models\Fund;
use Livewire\Component;

class View extends Component
{
    public $fund;

    public function mount($id)
    {
        $this->fund = Fund::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.fund.view');
    }
}
