<?php

namespace App\Livewire;

use App\Models\Supply;
use Livewire\Attributes\On;
use Livewire\Component;

class Navigation extends Component
{
    public $notifications;
    public function mount()
    {
        $this->notifications = Supply::where('total', '<', '10')->get();
    }
    public function render()
    {
        return view('livewire.navigation');
    }
}
