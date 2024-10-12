<?php

namespace App\Livewire;

use App\Livewire\Forms\NotificationForm;
use App\Models\Notification;
use App\Models\Supply;
use Exception;
use Livewire\Attributes\On;
use Livewire\Component;

class Navigation extends Component
{
    public NotificationForm $form;
    public $notifications;
    public function mount()
    {
        // $supplies = Supply::where('total', '<', 10)
        //     ->orWhere('expiry_date', '<=', now()->addMonth())
        //     ->get();

        // try {
        //     $supplies->each(function ($supply) {
        //         $this->form->user_id = auth()->user()->id;
        //         $this->form->title = $supply->notificationTitle;
        //         $this->form->message = $supply->notificationMessage;
        //         $this->form->store();
        //     });
        // } catch (Exception $e) {
        //     dd($e);
        // }

        $this->notifications = Notification::all();
    }
    public function render()
    {
        return view('livewire.navigation');
    }
}
