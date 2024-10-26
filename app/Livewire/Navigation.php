<?php

namespace App\Livewire;

use App\Livewire\Forms\NotificationForm;
use App\Models\BorrowedEquipment;
use App\Models\Notification;
use App\Models\Personnel;
use App\Models\Supply;
use Exception;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Navigation extends Component
{
    public NotificationForm $form;
    public $notificationCount = 0;

    #[On('notification_marked')]
    public function mount()
    {
        if (!session()->has('notificationSet')) {
            // Supplies
            DB::table('notifications')->delete();
            $supplies = Supply::where('total', '<', 10)
                ->orWhere('expiry_date', '<=', now()->addWeek())
                ->get();

            // Borrow Return
            $borrowedEquipment = BorrowedEquipment::whereNull('returned_date')->where('end_date', '<=', now()->addDay())
                ->get();

            // Personnel End Date
            $personnel = Personnel::whereBetween('end_date', [now()->format('Y-m-d'), now()->addWeek()])
                ->get();


            try {
                DB::transaction(function () use ($supplies, $borrowedEquipment, $personnel) {
                    $supplies->each(function ($supply) {
                        $this->form->user_id = auth()->user()->id;
                        $this->form->title = $supply->notificationTitle;
                        $this->form->message = $supply->notificationMessage;
                        $this->form->store();
                    });

                    $borrowedEquipment->each(function ($equipment) {
                        $this->form->user_id = auth()->user()->id;
                        $this->form->title = $equipment->notificationTitle;
                        $this->form->message = $equipment->notificationMessage;
                        $this->form->store();
                    });

                    $personnel->each(function ($person) {
                        $this->form->user_id = auth()->user()->id;
                        $this->form->title = $person->notificationTitle;
                        $this->form->message = $person->notificationMessage;
                        $this->form->store();
                    });
                });
                Session::put('notificationSet', true);
            } catch (Exception $e) {
                dd($e);
            }
        }



        $this->notificationCount = Notification::where('is_read', false)->get()->count();
    }

    public function render()
    {
        return view('livewire.navigation');
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return $this->redirect('/', navigate: true);
    }
}
