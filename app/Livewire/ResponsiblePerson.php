<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Models\ResponsiblePerson as ModelsResponsiblePerson;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class ResponsiblePerson extends Component
{
    use WithPagination;
    public ActivityLogForm $activityLogForm;

    public function render()
    {
        return view('livewire.responsible-person', [
            'persons' => ModelsResponsiblePerson::with('accounting_officer')->paginate(10)
        ]);
    }

    public function delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $person = ModelsResponsiblePerson::findOrFail($id);
                $person->delete();
                $this->activityLogForm->setActivityLog($person, null, 'Deleted Responsible Person', 'Delete');
                $this->activityLogForm->store();
            });
            Toaster::success('Deleted Successfully');
            $this->dispatch('Data Deleted');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
        }
    }
}
