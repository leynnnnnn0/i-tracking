<?php

namespace App\Livewire\Others;

use App\Models\Office as ModelsOffice;
use Livewire\Component;

class Office extends Component
{
    public $offices;
    public function mount()
    {
        $this->offices = ModelsOffice::take(5)->get();
    }
    public function render()
    {
        return view('livewire.others.office');
    }
}
