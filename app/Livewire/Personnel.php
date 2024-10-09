<?php

namespace App\Livewire;

use App\Enum\Gender;
use App\Livewire\Forms\ActivityLogForm;
use App\Models\Personnel as ModelsPersonnel;
use Exception;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Personnel extends Component
{
    public ActivityLogForm $activityLogForm;
    public function render()
    {
        return view('livewire.personnel', [
            'data' => ModelsPersonnel::latest()->paginate(10)
        ]);
    }


    public function delete($id): void
    {
        try {
            $personnel = ModelsPersonnel::findOrFail($id);
            $personnel->delete();
            $this->activityLogForm->setActivityLog($personnel, null, 'Delete Personnel', 'Delete');
            $this->activityLogForm->store();
            Toaster::success('Successfully Deleted!');
            $this->dispatch('Data Deleted');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
