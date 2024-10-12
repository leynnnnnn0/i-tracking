<?php

namespace App\Livewire;

use App\Models\Notification;
use App\Models\Supply;
use Livewire\Component;

class NotificationBar extends Component
{
    public $notifications;
    public function mount()
    {
        $this->notifications = Notification::all();
    }
    public function render()
    {
        return view('livewire.notification-bar');
    }
}
