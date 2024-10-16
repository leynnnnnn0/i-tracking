<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Models\User as ModelsUser;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class User extends Component
{
    use WithPagination;
    public ActivityLogForm $activityLogForm;
    public function render()
    {
        return view('livewire.user', [
            'users' => ModelsUser::latest()->paginate(10)
        ]);
    }

    public function downloadPdf()
    {
        return redirect()->route('users-pdf');
    }

    public function delete($id): void
    {
        try {
            DB::transaction(function () use ($id) {
                $user = ModelsUser::findOrFail($id);
                $this->activityLogForm->setActivityLog($user, null, 'Delete User', 'Delete');
                $user->delete();
                $this->activityLogForm->store();
            });
            Toaster::success('Successfully Deleted!');
            $this->dispatch('Data Deleted');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
