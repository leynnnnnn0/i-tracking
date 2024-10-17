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
    public $notificationCount = 0;

    // #[On('notification_marked')]
    // public function mount()
    // {
    //     $supplies = Supply::where('total', '<', 10)
    //         ->orWhere('expiry_date', '<=', now()->addMonth())
    //         ->get();


    //     try {
    //         $supplies->each(function ($supply) {
    //             $this->form->user_id = auth()->user()->id;
    //             $this->form->title = $supply->notificationTitle;
    //             $this->form->message = $supply->notificationMessage;


    //             // Notification::firstOrCreate($this->form->all());

    //             $notification = Notification::where([
    //                 'user_id' => $this->form->user_id,
    //                 'title' => $this->form->title,
    //                 'message' => $this->form->message,
    //             ])->first();

    //             if (!$notification)
    //                 $this->form->store();
    //         });
    //     } catch (Exception $e) {
    //         dd($e);
    //     }



    //     $this->notificationCount = Notification::where('is_read', false)->get()->count();
    // }

    public function render()
    {
        return view('livewire.navigation');
    }
}
