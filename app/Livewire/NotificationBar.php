<?php

namespace App\Livewire;

use App\Models\Supply;
use Livewire\Component;

class NotificationBar extends Component
{
    public $notifications;
    public function mount()
    {
        $this->notifications = Supply::where('total', '<', '10')->get();
        $this->dispatch('notifications', $this->notifications->count());
    }
    public function render()
    {
        return view('livewire.notification-bar');
    }
}
