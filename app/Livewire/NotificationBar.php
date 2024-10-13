<?php

namespace App\Livewire;

use App\Models\Notification;
use App\Models\Supply;
use Livewire\Attributes\On;
use Livewire\Component;

class NotificationBar extends Component
{
    public $notifications;
    #[On('notification_marked')]
    public function mount()
    {
        $this->notifications = Notification::where('is_read', false)->get();
    }
    public function render()
    {
        return view('livewire.notification-bar');
    }

    public function markAsRead($notification_id)
    {
        Notification::findOrFail($notification_id)->update([
            'is_read' => true
        ]);
        $this->dispatch('notification_marked', $this->notifications->count());
    }
}
