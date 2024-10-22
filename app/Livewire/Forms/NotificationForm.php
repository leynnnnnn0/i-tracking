<?php

namespace App\Livewire\Forms;

use App\Models\Notification;
use Livewire\Form;

class NotificationForm extends Form
{
    public $user_id;
    public $title;
    public $message;
    public $is_read = false;


    protected function rules()
    {
        return [
            'user_id' => ['required', 'exists:users,id'], 
            'title' => ['required', 'string', 'max:255'], 
            'message' => ['required', 'string'],           
            'is_read' => ['boolean'],                  
        ];
    }

    public function store()
    {
        Notification::create([
            'user_id' => $this->user_id,
            'title' => $this->title,
            'message' => $this->message,
            'is_read' => $this->is_read,
        ]);

        $this->reset();
    }

    public function setNotificationForm(Notification $notification)
    {
        $this->user_id = $notification->user_id;
        $this->title = $notification->title;
        $this->message = $notification->message;
        $this->is_read = $notification->is_read;
    }
}
